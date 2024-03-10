<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Models\JenisSurat;
use App\Models\PermohonanSuratKeluar;
use App\Models\PtpSppd;
use App\Services\Model\PsktService;
use App\Services\Model\PtpSppdService;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("surat-masuk")]
#[Propertis([
    "store_redirect" => "/pskt/show"
])]
#[Middleware("web")]
class SuratMasukController extends Controller
{

    public function show()
    {

        return view('pages.surat-masuk.show', $this->inQuery());
    }

    public function inQuery()
    {
        if (request()->get('type') == 'pskt') {
            return $this->inQueryPskt();
        } else if (request()->get('type') == 'ptpsppds') {
            return $this->inQueryPtpsppds();
        } else {
            return $this->inQueryPskt();
        }
        return [];
    }

    public function inQueryPskt()

    {
        $useData = [
            "Items" => PermohonanSuratKeluar::when(request()->get("tanggal"), function ($query) {

                $query->whereDate("tanggal", request()->get("tanggal"));

            })
                ->when(request()->get("search"), function ($query) {

                    $query->where("status_surat", "like", "%" . request()->get("search") . "%");

                })
                ->where([
                    'bawaslu_id' => auth()->user()->bawaslu->id,
                    "status_surat" => "pending"
                ])
                ->orderBy('id', 'desc')
                ->get(),
            ...(!empty(request()->id) ? collect($this->serviceClass->find(request()->id))->toArray() : [])
        ];

        if (request()->id) {
            $useData = array_merge($useData, [
                "pskt" => $this->serviceClass->find(request()->id)
            ]);
        }
        return $useData;
    }


    public function inQueryPtpsppds()
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
                    'bawaslu_id' => auth()->user()->bawaslu->id,
                    "status_surat" => "pending"
                ])
                ->orderBy('id', 'desc')
                ->get(),
            "jenis_surat" => JenisSurat::all(),
            ...(!empty(request()->id) ? collect($this->serviceClass->find(request()->id))->toArray() : [])
        ];

        if (request()->id) {
            $useData = array_merge($useData, [
                "ptpsppds" => PtpSppd::with("jenis_surat")
                    ->where("id", request()->id)
                    ->first(),
            ]);
        }


        return $useData;
    }

    // verify status surat
    #[Get("/{id}/verify")]
    public function verifyStatusByType()
    {
        if (request()->get('type') == 'pskt') {
            $pskt = new PsktService();
            $pskt->StatusUpdate(request()->id, 'verify');
            return redirect()->back();
        } else if (request()->get('type') == 'ptpsppds') {
            $ptpsppd = new PtpSppdService();
            $ptpsppd->StatusUpdate(request()->id, 'verify');
            return redirect()->back();
        } else {
            $pskt = new PsktService();
            $pskt->StatusUpdate(request()->id, 'verify');
            return redirect()->back();
        }
        return redirect()->back();
    }

    // reject status surat
    #[Get("/{id}/reject")]
    public function rejectStatusByType()
    {
        if (request()->get('type') == 'pskt') {
            $pskt = new PsktService();
            $pskt->StatusUpdate(request()->id, 'reject');
            return redirect()->back();
        } else if (request()->get('type') == 'ptpsppds') {
            $ptpsppd = new PtpSppdService();
            $ptpsppd->StatusUpdate(request()->id, 'reject');
            return redirect()->back();
        } else {
            $pskt = new PsktService();
            $pskt->StatusUpdate(request()->id, 'reject');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
