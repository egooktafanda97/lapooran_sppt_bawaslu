<?php

namespace App\Models;

use App\Attributes\Contract\ReflectionMeta;
use App\Attributes\Propertis;
use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table("jenis_surat")]
class JenisSurat extends Model
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
            "jenis_surat" => "required"
        ];
    }
}
