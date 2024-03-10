<?php

namespace App\Models;


use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Attribute\Rules as Rule;

use Attribute;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule as ValidationRule;
use ReflectionMethod;

#[Table("permohonan_surat_keluar")]
class PermohonanSuratKeluar extends Model
{
    use HasFactory;
    use InjectModel;

    protected $primaryKey = "id";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->Iject();
    }

    public static function rules()
    {
        return [
            'bawaslu_id' => 'required|integer|exists:bawaslu,id',
            'user_id' => 'required|integer|exists:users,id',
            'klasifikasi' => [
                'required',
                'string',
                ValidationRule::unique('permohonan_surat_keluar')->ignore(request()->id),
            ],
            'judul' => 'required',
            'tanggal' => 'required|date',
            'tanggal_dinas' => 'nullable|date',
            'perihal' => 'required|string',
            'tujuan_surat' => 'required|string',
            'pengirim' => 'nullable',
            'status_surat' => 'required',
            'lampiran' => 'nullable',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bawaslu()
    {
        return $this->belongsTo(Bawaslu::class);
    }

    // static generator no surat dengan format nomor ###/Singakatan kecamtan dari relasi bawaslu / tanggal
    public static function generateNomorSurat($bawaslu_id, $tanggal)
    {
        $bawaslu = Bawaslu::find($bawaslu_id);
        $tanggal = Date::parse($tanggal);
        // no surat adalah 3 angka dari 001 sampai 999
        $noSurat = PermohonanSuratKeluar::where('bawaslu_id', $bawaslu_id)
            ->whereYear('tanggal', $tanggal->year)
            ->count() + 1;
        $noSurat = str_pad($noSurat, 3, '0', STR_PAD_LEFT);
        return $noSurat . '/' . $bawaslu->singkatan_penomoran_surat . '/RA-' . $tanggal->format('d/m/Y');
    }
}
