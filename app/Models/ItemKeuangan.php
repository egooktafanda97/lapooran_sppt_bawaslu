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
        'user_id',
        'bawaslu_id',
        'no_surat_pencairan',
        'dikeluarkan_oleh',
        'nama_penerima',
        'uraian',
        'tanggal_surat',
        'tanggal_terima',
        'nomor',
        'jumlah',
        'ppn',
        'pph',
    ];

    public function keuangan()
    {
        return $this->belongsTo(Keuangan::class, 'keuangan_id');
    }

    public function rules()
    {
        return [
            'keuangan_id' => 'nullable|integer',
            'user_id' => 'required|integer',
            'bawaslu_id' => 'required|integer',
            'no_surat_pencairan' => 'nullable|string|max:255',
            'dikeluarkan_oleh' => 'required|integer',
            'nama_penerima' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'nomor' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'ppn' => 'nullable|string|max:255',
            'pph' => 'nullable|string|max:255',
        ];
    }
}
