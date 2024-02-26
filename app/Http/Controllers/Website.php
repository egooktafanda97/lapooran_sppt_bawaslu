<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSuratKeluar;
use App\Traits\InjectableAttributes;
use Package\Utilities\ReflectionExtractor;
use Spatie\RouteAttributes\Attributes\Get;
use Illuminate\Http\Request;
use Package\Model\src\ModelAttributes;


class Website extends Controller
{
    use InjectableAttributes;
    public function __construct(ModelAttributes $modelAttributes)
    {
        $this->injectedAttributes = $modelAttributes;
    }

    #[Get("website")]
    public function index()
    {
        $model = new PermohonanSuratKeluar();

        $extractor = new ReflectionExtractor($model);

        // Ekstraksi properti beserta atributnya
        $propertiesWithAttributes = $extractor->extractPropertiesWithAttributes();

        // Ekstraksi metode beserta atributnya
        $methodsWithAttributes = $extractor->extractMethodsWithAttributes();

        // Ekstraksi atribut dari kelas itu sendiri
        $classAttributes = $extractor->extractClassAttributes();

        // Struktur hierarkis untuk menyimpan hasil ekstraksi
        $classData = [
            "class" => $classAttributes,
            'properties' => $propertiesWithAttributes,
            'methods' => $methodsWithAttributes,
        ];
        dd($classData);
    }
}
