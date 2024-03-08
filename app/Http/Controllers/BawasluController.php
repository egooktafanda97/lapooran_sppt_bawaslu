<?php

namespace App\Http\Controllers;

use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Models\Bawaslu;
use App\Models\User;
use App\Models\wilayah_provinsi;
use App\Services\Model\BawasluService;
use App\Services\User\AccountService;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Prefix;

use function Symfony\Component\String\b;

#[Prefix("bawaslu")]
#[Propertis([
    "store_redirect" => "/bawaslu/show"
])]
#[StaticModelRules(Bawaslu::class)]
#[Service(BawasluService::class)]
class BawasluController extends Controller
{
    use Crud;

    public function __construct()
    {
        $this->Initialize();
        $this->setData();
    }

    public function setData()
    {
        $this->dataView = [
            "provinsi" => wilayah_provinsi::all(),
            "Items" => Bawaslu::with("provinsi", "kabupaten", "kecamatan")->get()
        ];
    }

    public function findBy($id)
    {
        return Bawaslu::with("provinsi", "kabupaten", "kecamatan")->find($id);
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
        $upModel = Bawaslu::find($model->id);
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
