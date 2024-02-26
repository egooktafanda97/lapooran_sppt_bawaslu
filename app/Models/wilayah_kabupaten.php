<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_kabupaten extends Model
{
    use HasFactory;
    protected $table = "wilayah_kabupaten";
    protected $fillable = [
        "id_kabupaten",
        "provinsi_id",
        "nama_kabupaten"
    ];

    public function provinsi()
    {
        return $this->belongsTo(wilayah_provinsi::class, 'provinsi_id', 'id_provinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany(wilayah_kecamatan::class, 'kabupaten_id', 'id_kabupaten');
    }
}
