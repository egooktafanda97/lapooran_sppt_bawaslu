<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Str;


class BaseControllers extends Controller
{

    public function show(Request $request)
    {
        return view($request->view);
    }
}
