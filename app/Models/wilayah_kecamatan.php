<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_kecamatan extends Model
{
    use HasFactory;
    protected $table = "wilayah_kecamatan";
    protected $fillable = [
        "id_kecamatan",
        "kabupaten_id",
        "nama_kecamatan",
        "ibukota_kecamatan"
    ];

    public function kabupaten()
    {
        return $this->belongsTo(wilayah_kabupaten::class, 'kabupaten_id', 'id_kabupaten');
    }

    public function kelurahan()
    {
        return $this->hasMany(wilayah_desa::class, 'kecamatan_id', 'id_kecamatan');
    }
}
