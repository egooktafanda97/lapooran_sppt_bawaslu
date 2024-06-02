<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Exports\ExportExcels;
use App\Helpers\Utility;
use App\Http\Requests\FormRequests;
use App\Models\Anggota;
use App\Models\JenisSurat;
use App\Models\PtpSppd;
use App\Services\Model\PtpSppdService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("ptpsppds")]
#[Propertis([
    "store_redirect" => "/ptpsppds/show"
])]
#[StaticModelRules(PtpSppd::class)]
#[Service(PtpSppdService::class)]
#[Middleware("web")]
class PtpsppdsController extends Controller
{
    use Crud;
    public function __construct(Request $request)
    {
        $request->merge([
            'user_id' => auth()->user()->id ?? null,
            'bawaslu_id' => auth()->user()->anggota->bawaslu->id ?? null,
            'status_surat' => 'pending',
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
            'lampiran-ptpsppds'
        );
        $request = collect($request)->merge([
            "lampiran" => $uploadImg->name ?? null
        ]);
        return $next($req, $request);
    }

    // before update
    public function beforeUpdate($req, $request, callable $next)
    {
        $request = $request->validated();
        $uploadImg = Utility::Images(
            $req,
            'lampiran',
            'lampiran-ptpsppds'
        );
        if ($uploadImg->name) {
            $request = collect($request)->merge([
                "lampiran" => $uploadImg->name
            ]);
        }
        return $next($req, $request);
    }

    public function data_view(): array
    {
        $useData = [
            "Items" => PtpSppd::with("jenis_surat")
                ->when(request()->get("tanggal"), function ($query) {
                    $query->whereDate("tanggal_keluar_st", request()->get("tanggal"));
                })
                ->when(request()->get("search"), function ($query) {
                    $query->where("status_surat", "like", "%" . request()->get("search") . "%");
                })
                ->where([
                    'user_id' => auth()->user()->id,
                    'bawaslu_id' => auth()->user()->anggota->bawaslu->id
                ])
                ->orderBy('id', 'desc')
                ->get(),
            "jenis_surat" => JenisSurat::all(),
            ...(!empty(request()->id) ? collect($this->serviceClass->find(request()->id))->toArray() : [])
        ];

        if (request()->id) {
            $useData = array_merge($useData, [
                "ptpsppds" =>  PtpSppd::with("jenis_surat")
                    ->where("id", request()->id)
                    ->first(),
            ]);
        }


        return $useData;
    }

    public function excel()
    {
        $data = PtpSppd::with("jenis_surat", "bawaslu", "user")
            ->when(request()->get("tanggal"), function ($query) {
                $query->whereDate("tanggal_keluar_st", request()->get("tanggal"));
            })
            ->when(request()->get("search"), function ($query) {

                $query->where("status_surat", "like", "%" . request()->get("search") . "%");
            })
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($q) {
                unset($q->jenis_surat_id);
                if ($q->bawaslu) {
                    return [
                        "bawaslu" => $q->bawaslu->nama  ?? "",
                        "anggota" => Anggota::whereuserId($q->user_id)->first()->nama,
                        "nama" => $q->nama,
                        "tanggal_keluar_st" => Carbon::parse($q->tanggal_keluar_st)->format("Y-m-d"),
                        "tanggal_berangkat" => Carbon::parse($q->tanggal_berangkat)->format("Y-m-d"),
                        "tanggal_pulang" => Carbon::parse($q->tanggal_pulang)->format("Y-m-d"),
                        "no_spt" => $q->no_spt,
                        "jenis_surat" => $q->jenis_surat->jenis_surat,
                        "perihal" => $q->perihal,
                        "biaya" => number_format($q->biaya),
                    ];
                }
            });
        return Excel::download(new ExportExcels($data, [
            'Bawaslu',
            'Anggota Pemohon',
            'Nama',
            'Tanggal Keluar ST',
            'Tanggal Berangkat',
            'Tanggal Pulang',
            'No. SPT',
            'Jenis Surat',
            'Perihal',
            'Biaya'
        ]), 'exports.xlsx');
    }
}
