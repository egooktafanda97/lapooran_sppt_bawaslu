<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcels;
use App\Models\Anggota;
use App\Models\PermohonanSuratKeluar;
use App\Models\PtpSppd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\RouteAttributes\Attributes\Get;

class LaporanController extends Controller
{
    public function show()
    {
        return view('pages.laporan.show', $this->inQuery());
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
                    'bawaslu_id' => auth()->user()->bawaslu->id
                ])
                ->whereIn('status_surat', ['verify', 'reject'])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ];
        return $useData;
    }

    public function inQueryPtpsppds()
    {
        $useData = [
            "Items" => PtpSppd::when(request()->get("tanggal"), function ($query) {
                $query->whereDate("tanggal", request()->get("tanggal"));
            })
                ->when(request()->get("search"), function ($query) {
                    $query->where("status_surat", "like", "%" . request()->get("search") . "%");
                })
                ->where([
                    'bawaslu_id' => auth()->user()->bawaslu->id
                ])
                ->whereIn('status_surat', ['verify', 'reject'])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ];
        return $useData;
    }


    #[Get("/laporan/excel")]
    public  function  excel()
    {
        if (request()->get('type') == 'pskt') {
            return $this->typePsktExcel();
        } else if (request()->get('type') == 'ptpsppds') {
            return $this->typePtbexcel();
        } else {
            return $this->typePsktExcel();
        }
        return [];
    }

    public function typePsktExcel()
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
                    'status_surat' => $record->status_surat == 'verify' ? 'Terverifikasi' : 'Ditolak'
                ];
            });

        return Excel::download(new ExportExcels($data, [
            'klasifikasi',
            'judul',
            'tanggal',
            'perihal',
            'tujuan surat',
            'pengirim',
            'status surat'
        ]), 'exports.xlsx');

    }

    public function typePtbexcel()
    {
        $data = PtpSppd::with("jenis_surat", "bawaslu", "user")
            ->when(request()->get("tanggal"), function ($query) {
                $query->whereDate("tanggal_keluar_st", request()->get("tanggal"));
            })
            ->when(request()->get("search"), function ($query) {

                $query->where("status_surat","like", "%".request()->get("search")."%");

            })
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($q) {
                unset($q->jenis_surat_id);
                return [
                    "bawaslu" => $q->bawaslu->nama,
                    "anggota" => Anggota::whereuserId($q->user_id)->first()->nama,
                    "nama" => $q->nama,
                    "tanggal_keluar_st" => Carbon::parse($q->tanggal_keluar_st)->format("Y-m-d"),
                    "tanggal_berangkat" => Carbon::parse($q->tanggal_berangkat)->format("Y-m-d"),
                    "tanggal_pulang" => Carbon::parse($q->tanggal_pulang)->format("Y-m-d"),
                    "no_spt" => $q->no_spt,
                    "jenis_surat" => $q->jenis_surat->jenis_surat,
                    "perihal" => $q->perihal,
                    'status_surat' => $q->status_surat == 'verify' ? 'Terverifikasi': 'Ditolak'
                ];
            });


        return Excel::download(new ExportExcels($data, [
            'Bawaslu',
            'Anggota Pemohon',
            'Nama',
            'Tanggal Keluar ST',
            'Tanggal Berangkat',
            'Tanggal Pulang',
            'No. SPT',
            'Perihal',
            'status surat'
        ]), 'exports.xlsx');
    }
}
