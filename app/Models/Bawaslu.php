<?php

namespace App\Models;

use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table("bawaslu")]
class Bawaslu extends Model
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
            "user_id" => "nullable",
            "nama" => "required",
            "singkatan_penomoran_surat" => "required",
            "provinsi_id" => "required",
            "kabupaten_id" => "required",
            "kecamatan_id" => "required",
        ];
    }

    //relation provinsi , kabupaten, kecamatan
    public function provinsi()
    {
        return $this->belongsTo(wilayah_provinsi::class, "provinsi_id", "id_provinsi");
    }

    public function kabupaten()
    {
        return $this->belongsTo(wilayah_kabupaten::class, "kabupaten_id", "id_kabupaten");
    }

    public function kecamatan()
    {
        return $this->belongsTo(wilayah_kecamatan::class, "kecamatan_id", "id_kecamatan");
    }
    //user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
