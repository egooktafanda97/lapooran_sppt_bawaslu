<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_provinsi extends Model
{
    use HasFactory;
    protected $table = "wilayah_provinsi";
    protected $fillable = [
        "id_provinsi",
        "nama_provinsi"
    ];

    public function kabupaten()
    {
        return $this->hasMany(wilayah_kabupaten::class, "provinsi_id", "id_provinsi");
    }
}
