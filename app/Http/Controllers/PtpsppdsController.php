<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequests;
use App\Models\PtpSppd;

use Illuminate\Http\Request;

class PtpsppdsController extends Controller
{
    public function __construct()
    {
        $this->middleware(["web", "auth"]);
        app()->bind(FormRequests::class, function ($app) {
            return new FormRequests(PtpSppd::rules());
        });
    }
    public function index(FormRequests $formRequest)
    {
        dd($formRequest->rules());
        // return view($request->view);
    }
}
