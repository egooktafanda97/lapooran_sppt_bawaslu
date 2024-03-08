<?php

namespace App\Http\Controllers;

use App\Models\wilayah_kabupaten;
use App\Models\wilayah_provinsi;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function provinsi()
    {
        $provinsi = wilayah_provinsi::all();
        return response()->json($provinsi);
    }

    // get kabupaten by provinsi
    public function kabupaten($id_provinsi)
    {
        $kabupaten = wilayah_provinsi::where("id_provinsi", $id_provinsi)
            ->with("kabupaten")
            ->first()
            ->kabupaten;
        return response()->json($kabupaten);
    }

    // get kecamatan by kabupaten
    public function kecamatan($id_kabupaten)
    {
        $kecamatan = wilayah_kabupaten::where("id_kabupaten", $id_kabupaten)
            ->with("kecamatan")
            ->first()
            ->kecamatan;
        return response()->json($kecamatan);
    }
}
