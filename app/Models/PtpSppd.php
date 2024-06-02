<?php

namespace App\Models;

use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table("ptp_sppd")]
class PtpSppd extends Model
{
    use HasFactory;
    use InjectModel;

    protected $primaryKey = "id";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->Iject();
    }

    // protected $fillable = [
    //     'bawaslu_id',
    //     'user_id',
    //     'nama',
    //     'tanggl_keluar_st',
    //     'tanggal_berangkat',
    //     'tanggal_pulang',
    //     'no_spt',
    //     'jenis_surat_id',
    //     'perihal',
    //     'status_surat',
    //     'lampiran',
    // ];

    protected $dates = [
        'tanggal_keluar_st',
        'tanggal_berangkat',
        'tanggal_pulang',
    ];

    public static function rules()
    {
        return [
            'bawaslu_id' => 'required|integer',
            'user_id' => 'required|integer',
            'nama' => 'required|string',
            'tanggal_keluar_st' => 'required|date',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date',
            'no_spt' => 'required|string',
            'jenis_surat_id' => 'required|string',
            'perihal' => 'required|string',
            'status_surat' => 'nullable|string',
            'biaya' => 'required',
            'lampiran' => 'nullable',
        ];
    }

    // jenis_surat
    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    // bawaslu
    // bawaslu
    public function bawaslu()
    {
        return $this->belongsTo(Bawaslu::class);
    }

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
