<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangan';

    protected $fillable = [
        'user_id',
        'bawaslu_id',
        'no_surat',
        'no_dipa',
        'tanggal_dikeluarkan',
        'tanggal_start',
        'tanggal_end',
        'klarifikasi_belnja',
        'pengeluaran',
        'sts',
        'lampiran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bawaslu()
    {
        return $this->belongsTo(Bawaslu::class, 'bawaslu_id');
    }

    public function items()
    {
        return $this->hasMany(ItemKeuangan::class, 'keuangan_id');
    }
}
