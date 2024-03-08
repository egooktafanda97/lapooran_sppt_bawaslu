<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\StaticModelRules;
use App\Attributes\Service;
use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\User;
use App\Services\User\AnggotaService;
use App\Services\User\JabatanService;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("anggota")]
#[Propertis([
    "store_redirect" => "/anggota/show"
])]
#[StaticModelRules(Anggota::class)]
#[Service(AnggotaService::class)]
class AnggotaController extends Controller
{
    use Crud;
    public function __construct(public JabatanService $jabatanService, Request $request)
    {
        $request->merge([
            'status_anggota' => 'aktif',
            'bawaslu_id' => 1,
            'user_id' => 1,
        ]);
        $this->Initialize();
    }

    public function data_view(): array
    {
        $useData = [
            "jabatan" => $this->jabatanService->all(),
            "Items" => $this->serviceClass->all(),
            ...(!empty(request()->id) ? collect($this->serviceClass->find(request()->id))->toArray() : [])
        ];
        return $useData;
    }

    /**
     * {@inheritdoc}
     */
    public function thenStore($request, $model)
    {

        $AccountService =  User::create([
            "name" => $request->nama,
            "username" => $request->username,
            "password" => bcrypt($request->password),
            "role" => "bawaslu"
        ]);
        $upModel = Anggota::find($model->id);
        $upModel->user_id = $AccountService->id;
        $upModel->save();
    }

    public function thenUpdate($request, $model, $id)
    {
        $AccountService = new AccountService();
        $AccountService->update($id, [
            "name" => $request->nama,
            "username" => $request->username,
            "password" => bcrypt($request->password),
            "role" => "bawaslu"
        ]);
    }
}
