<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PtpSppd extends Model
{
    use HasFactory;

    protected $fillable = [
        'bawaslu_id',
        'user_id',
        'nama',
        'tanggl_keluar_st',
        'tanggal_berangkat',
        'tanggal_pulang',
        'no_spt',
        'jenis_surat_id',
        'perihal',
        'status_surat',
        'lampiran',
    ];

    protected $dates = [
        'tanggl_keluar_st',
        'tanggal_berangkat',
        'tanggal_pulang',
    ];

    public static function rules()
    {
        return [
            'bawaslu_id' => 'required|integer',
            'user_id' => 'required|integer',
            'nama' => 'required|string',
            'tanggl_keluar_st' => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date',
            'no_spt' => 'required|string',
            'jenis_surat_id' => 'required|string',
            'perihal' => 'required|string',
            'status_surat' => 'nullable|string',
            'lampiran' => 'nullable|string',
        ];
    }
}
