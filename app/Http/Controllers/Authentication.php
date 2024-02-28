<?php

namespace App\Http\Controllers;

use App\Services\Auth\Authentication as AuthAuthentication;
use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function show(Request $request, AuthAuthentication $auth)
    {
        if ($request->isMethod('post')) {
            $auths = $auth->auth($request);
            if ($auth)
                return redirect("/home/show");
        }
        return view("authentication.login");
    }
}
