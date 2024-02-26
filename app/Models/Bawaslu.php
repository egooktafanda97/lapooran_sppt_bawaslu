<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bawaslu extends Model
{
    use HasFactory;
    protected $table = 'permohonan_surat_keluar';
    protected $primaryKey = "id";
    protected $fillable = [
        "nama"
    ];
}
