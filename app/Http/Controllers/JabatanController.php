<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\StaticModelRules;
use App\Attributes\Service;
use App\Models\Jabatan;
use App\Services\User\JabatanService;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("jabatan")]
#[Propertis([
    "store_redirect" => "/jabatan/show"
])]
#[StaticModelRules(Jabatan::class)]
#[Service(JabatanService::class)]
class JabatanController extends Controller
{
    use Crud;
}
