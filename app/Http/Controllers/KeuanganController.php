<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Exports\ExportExcels;
use App\Helpers\Utility;
use App\Models\Anggota;
use App\Models\Bawaslu;
use App\Models\ItemKeuangan;
use App\Models\Keuangan;
use App\Models\PermohonanSuratKeluar;
use App\Models\User;
use App\Services\Model\PsktService;
use App\Services\User\AnggotaService;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use stdClass;

#[Prefix("keuangan")]
#[Middleware("web")]
class KeuanganController extends Controller
{
    #[Get("show")]
    public function show()
    {
        return view('pages.keuangan.show-keuangan', [
            "keuangan" => Keuangan::where("user_id", auth()->user()->id)->with("items")->get()
        ]);
    }

    #[Get("show-all")]
    public function showAll()
    {
        return view('pages.keuangan.show-report', [
            "keuangan" => Keuangan::with("items")->get()
        ]);
    }

    #[Get("report/{id}")]
    public function report($id)
    {
        return view('pages.keuangan.report', [
            "keuangan" => Keuangan::where("user_id", auth()->user()->id)->whereId($id)->with("items")->first()
        ]);
    }


    #[Get("report-super/{id}")]
    public function reportSuper($id)
    {
        return view('pages.keuangan.report', [
            "keuangan" => Keuangan::whereId($id)->with("items")->first()
        ]);
    }


    //create
    #[Get("create/{id?}")]
    public function create($id = null)
    {
        $data = [
            "keuangan" => Keuangan::where("id", $id)->with("items")->first(),
        ];
        return view('pages.keuangan.create', $data);
    }



    #[Post("store")]
    public function store(Request $request)
    {
        if ($request->id != null)
            return $this->update($request);
        try {
            $upload = Utility::Images($request, "lampiran", "lampiran_keuangan");
            $keu = Keuangan::create([
                "user_id" => auth()->user()->id,
                "bawaslu_id" => Bawaslu::where("user_id", auth()->user()->id)->first()->id ?? Anggota::where("user_id", auth()->user()->id)->first()->bawaslu_id,
                "no_surat" => $request->no_surat,
                "no_dipa" => $request->no_dipa,
                "tanggal" => $request->tanggal,
                "klarifikasi_belnja" => $request->klarifikasi_belnja,
                "pengeluaran" => $request->pengeluaran,
                "sts" => $request->sts,
                "lampiran" => $upload->status ? $upload->name : null,
            ]);
            $items  = json_decode($request->items ?? [], true);
            foreach ($items as $key => $value) {
                $keu->items()->create([
                    "keuangan_id" => $keu->id,
                    "max" => $value['max'],
                    "nama_penerima" => $value['nama_penerima'],
                    "uraian" => $value['uraian'],
                    "tanggal" => $value['tanggal'],
                    "nomor" => $value['nomor'],
                    "jumlah" => $value['jumlah'],
                    "ppn" => $value['ppn'],
                    "pph" => $value['pph'],
                ]);
            }
            return redirect("keuangan/show");
        } catch (\Throwable $th) {
            return redirect("keuangan/create");
        }
    }

    #[Get("create/{id}")]
    public function createId($id)
    {
        $data = [
            "keuangan" => Keuangan::whereId($id)->with("items")->first()
        ];
        return view('pages.keuangan.create', $data);
    }

    public function update($request)
    {

        try {
            $upload = Utility::Images($request, "lampiran", "lampiran_keuangan");
            $keu = Keuangan::find($request->id);
            $keu->update([
                "user_id" => auth()->user()->id,
                "bawaslu_id" => Bawaslu::where("user_id", auth()->user()->id)->first()->id ?? Anggota::where("user_id", auth()->user()->id)->first()->bawaslu_id,
                "no_surat" => $request->no_surat,
                "no_dipa" => $request->no_dipa,
                "tanggal" => $request->tanggal,
                "klarifikasi_belnja" => $request->klarifikasi_belnja,
                "pengeluaran" => $request->pengeluaran,
                "sts" => $request->sts,
                "lampiran" => $upload->status ? $upload->name : null,
            ]);
            ItemKeuangan::where("keuangan_id", $request->id)->delete();
            $items  = json_decode($request->items ?? [], true);
            foreach ($items as $key => $value) {
                $keu->items()->create([
                    "keuangan_id" => $keu->id,
                    "max" => $value['max'],
                    "nama_penerima" => $value['nama_penerima'],
                    "uraian" => $value['uraian'],
                    "tanggal" => $value['tanggal'],
                    "nomor" => $value['nomor'],
                    "jumlah" => $value['jumlah'],
                    "ppn" => $value['ppn'],
                    "pph" => $value['pph'],
                ]);
            }
            return redirect("keuangan/show");
        } catch (\Throwable $th) {
            return redirect("keuangan/create");
        }
    }

    #[Get("destroy/{id}")]
    public function destroy($id)
    {
        Keuangan::find($id)->delete();
        ItemKeuangan::where("keuangan_id", $id)->delete();
        return redirect("keuangan/show");
    }
}
