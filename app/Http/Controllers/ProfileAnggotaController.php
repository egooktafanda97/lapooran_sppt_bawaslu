<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Models\Anggota;
use App\Models\User;
use App\Services\User\AccountService;
use App\Services\User\AnggotaService;
use App\Services\User\JabatanService;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("profile-anggota")]
#[Propertis([
    "store_redirect" => "/profile-anggota/show"
])]
#[StaticModelRules(Anggota::class)]
#[Service(AnggotaService::class)]
#[Middleware("web")]
class ProfileAnggotaController extends Controller
{
    use Crud;

    public function __construct(public JabatanService $jabatanService, Request $request)
    {
        $request->merge([
            'status_anggota' => 'aktif',
            'bawaslu_id' => auth()->user()->anggota->bawaslu->id,
        ]);
        $this->Initialize();
    }

    public function data_view(): array
    {
        $useData = [
            "jabatan" => $this->jabatanService->all(),
            "Items" => $this->serviceClass->all(),
            ...(!empty(auth()->user()->anggota->id) ? collect($this->serviceClass->find(auth()->user()->anggota->id))->toArray() : [])
        ];
        return $useData;
    }

    public function thenUpdate($request, $model, $id)
    {
        $AccountService = new AccountService();
        $data = [
            "name" => $request->nama,
            "username" => $request->username,
            "role" => "bawaslu"
        ];
        if ($request->password)
            $data["password"] = bcrypt($request->password);

        User::whereId($model->user_id)->update($data);
    }
}
