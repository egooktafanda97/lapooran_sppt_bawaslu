<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Package\Attribute\Model as AttributeModel;
use ReflectionClass;
use Talium\WizardAbstract\HalloClass;

class HomeController extends Controller
{
    use AutoCrud;


    public function show(Request $request)
    {
        $hallo = new HalloClass();
        return view($request->view);
    }
}
