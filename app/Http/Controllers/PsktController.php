<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Exports\ExportExcels;
use App\Helpers\Utility;
use App\Models\Anggota;
use App\Models\PermohonanSuratKeluar;
use App\Models\User;
use App\Services\Model\PsktService;
use App\Services\User\AnggotaService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;
use stdClass;

#[Prefix("pskt")]
#[Propertis([
    "store_redirect" => "/pskt/show"
])]
#[StaticModelRules(PermohonanSuratKeluar::class)]
#[Service(PsktService::class)]
#[Middleware("web")]
class PsktController extends Controller
{
    use Crud;


    public function __construct(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id,
            'bawaslu_id' => auth()->user()->anggota->bawaslu->id,
            'status_surat' => 'pending',
            'pengirim' => auth()->user()->anggota->id,
        ]);
        $this->Initialize();
    }

    // before store
    public function beforeStore($req, $request, callable $next)
    {
        $request = $request->validated();
        $uploadImg = Utility::Images(
            $req,
            'lampiran',
            'lampiran'
        );
        $request = collect($request)->merge([
            "lampiran" => $uploadImg->name ?? null
        ]);
        return $next($req, $request);
    }

    public function data_view(): array
    {
        $last = auth()->user()->anggota->bawaslu->id;
        $useData = [
            "Items" => PermohonanSuratKeluar::when(request()->get("tanggal"), function ($query) {

                $query->whereDate("tanggal", request()->get("tanggal"));

            })
                ->when(request()->get("search"), function ($query) {

                    $query->where("status_surat", "like", "%" . request()->get("search") . "%");

                })
                ->where("bawaslu_id", $last)
                ->where([
                    'user_id' => auth()->user()->id,
                    'bawaslu_id' => auth()->user()->anggota->bawaslu->id
                ])
                ->orderBy('id', 'desc')
        ->get(),
            "no_surat" => $this->serviceClass->builder()->getModel()::generateNomorSurat($last, date('Y-m-d')),
            ...(!empty(request()->id) ? collect($this->serviceClass->find(request()->id))->toArray() : [])
        ];

        if (request()->id) {
            $useData = array_merge($useData, [
                "pskt" => $this->serviceClass->find(request()->id)
            ]);
        }
        return $useData;
    }

    // excel buat seperti PtpsppdsController

    public function excel()
    {
        $data = PermohonanSuratKeluar::
        when(request()->get("tanggal"), function ($query) {

            $query->whereDate("tanggal", request()->get("tanggal"));

        })
            ->when(request()->get("search"), function ($query) {

                $query->where("status_surat", "like", "%" . request()->get("search") . "%");

            })
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($record) {
                return [
                    'klasifikasi' => $record->klasifikasi,
                    'judul' => $record->judul,
                    'tanggal' => $record->tanggal,
                    'perihal' => $record->perihal,
                    'tujuan_surat' => $record->tujuan_surat,
                    'pengirim' => Anggota::whereId($record->pengirim)->first()->nama ?? null,
                ];
            });

        return Excel::download(new ExportExcels($data, [
            'klasifikasi',
            'judul',
            'tanggal',
            'perihal',
            'tujuan surat',
            'pengirim',
        ]), 'exports.xlsx');

    }

}
