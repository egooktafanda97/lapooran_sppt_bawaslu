<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemKeuangan extends Model
{
    use HasFactory;
    protected $table = 'item_keuangan';

    /**
     * Daftar atribut yang dapat diisi massal.
     *
     * @var array
     */
    protected $fillable = [
        'keuangan_id',
        'max',
        'nama_penerima',
        'uraian',
        'tanggal',
        'nomor',
        'jumlah',
        'ppn',
        'pph',
    ];

    public function keuangan()
    {
        return $this->belongsTo(Keuangan::class, 'keuangan_id');
    }
}
