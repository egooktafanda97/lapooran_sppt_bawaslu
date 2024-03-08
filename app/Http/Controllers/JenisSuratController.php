<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Models\JenisSurat;
use App\Services\Surat\JenisSuratService;
use Attribute;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("jenis-surat")]
#[Propertis([
    "store_redirect" => "/jenis-surat/show"
])]
#[StaticModelRules(JenisSurat::class)]
#[Service(JenisSuratService::class)]
class JenisSuratController extends Controller
{
    use Crud;
}
