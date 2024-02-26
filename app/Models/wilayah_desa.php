<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_desa extends Model
{
    use HasFactory;
    protected $table = "wilayah_desa";
    protected $fillable = [
        "id_desa",
        "kecamatan_id",
        "nama_desa",
        "ibu_kota_desa",
        "sebutan_desa"
    ];

    public function kecamatan()
    {
        return $this->belongsTo(wilayah_provinsi::class, 'kecamatan_id', 'id_kecamatan');
    }
}
