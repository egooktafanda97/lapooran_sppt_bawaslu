<?php

namespace App\Models;

use App\Attributes\Table;
use App\Traits\InjectModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

#[Table("jabatan")]
class Jabatan extends Model
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
            "nama" => "required",
            "keterangan" => 'nullable'
        ];
    }
}
