<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Attribute\Rules as Rule;

use Attribute;
use Illuminate\Support\Facades\Date;
use ReflectionMethod;



class PermohonanSuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'permohonan_surat_keluar';
    protected $primaryKey = "id";

    protected $fillable = [
        'bawaslu_id',
        'user_id',
        'kode_surat',
        'klasifikasi',
        'tanggal',
        'tanggal_dinas',
        'perihal',
        'tujuan_surat',
        'pengirim',
        'status_surat',
        'lampiran',
        'user_id',
        'bawaslu_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bawaslu()
    {
        return $this->belongsTo(Bawaslu::class);
    }
}
