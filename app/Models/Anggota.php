<?php

namespace App\Models;

use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table("anggota")]
class Anggota extends Model
{
    use HasFactory;
    use InjectModel;

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
        $this->Iject();
    }

    public static function rules()
    {
        return [
            'bawaslu_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            'jabatan_id' => 'required|integer',
            'no_sk' => 'required|string',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan', // Menyediakan pilihan Laki-laki atau Perempuan
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status_anggota' => 'required|string|in:aktif,nonaktif' // Menyediakan pilihan aktif atau nonaktif
        ];
    }


    public function bawaslu()
    {
        return $this->belongsTo(Bawaslu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
