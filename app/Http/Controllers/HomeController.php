<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    use AutoCrud;

    public function show(Request $request)
    {
        $this->args = [
            "main" => "ok gas"
        ];
        return view($request->view);
    }
}
