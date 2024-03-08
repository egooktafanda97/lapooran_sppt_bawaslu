<?php

namespace App\Http\Controllers;

use App\Attributes\Contract\ReflectionMeta;
use App\Attributes\Propertis;
use App\Attributes\Service;
use App\Attributes\StaticModelRules;
use App\Http\Requests\FormRequests;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

trait Crud
{
    protected $model;
    protected  $store_redirect;
    protected $serviceClass;
    protected $dataView = [];
    public function Initialize()
    {
        $props = (object) collect(ReflectionMeta::getAttribute($this, Propertis::class, 'props'))->toArray();
        $service = ReflectionMeta::getAttribute($this, Service::class, 'service');


        if (!empty($props->MainModel))
            $this->model =  $props->MainModel;
        if (!empty($props->store_redirect))
            $this->store_redirect = $props->store_redirect;

        if (!empty($service)) {
            $this->serviceClass = new $service();
        }
        $StaticModelRules = ReflectionMeta::getAttribute($this, StaticModelRules::class, 'rules');

        app()->bind(FormRequests::class, function ($app) use ($StaticModelRules) {
            $instace_model = $StaticModelRules;
            return new FormRequests($instace_model);
        });
    }

    public function thenStore($request, $model)
    {
        return null;
    }

    public function thenUpdate($request, $model, $id)
    {
        return null;
    }

    public function __construct()
    {
        $this->Initialize();
    }

    #[Get("/show")]
    public function show(Request $request)
    {
        return view($request->view, $this->data_view());
    }

    public function data_view()
    {
        if (!empty($this->serviceClass)) {
            $Items =  $this->serviceClass->all();
        } else {
            $Items = $this->model::all();
        }

        return ["Items" => $Items, ...$this->dataView];
    }

    #[Get("/create", middleware: "web")]
    public function create(Request $request)
    {
        return view($request->view, $this->data_view());
    }

    #[Get("/create/{id}", middleware: "web")]
    public function createUpdate(Request $request)
    {
        return view($request->view, $this->data_view());
    }

    #[Post("/store")]
    public function store(Request $req, FormRequests $request)
    {
        try {
            $validatedData = collect($request->validated());
            if (!empty($this->apped_save))
                $validatedData->merge($this->apped_save);
            if (!empty($this->serviceClass))
                $model = $this->serviceClass->create($validatedData->toArray());
            else
                $model = $this->model::create($validatedData->toArray());

            if (!$model) {
                throw new \Exception("Error saving data");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        if (!empty($this->store_redirect)) {
            $this->thenStore($req, $model);
            return redirect($this->store_redirect)->with('success', 'Data successfully saved');
        }

        return redirect()->back()->with('success', 'Data successfully saved');
    }

    #[Post("/update/{id}")]
    #[Post("/store/{id}")]
    public function update(Request $req, FormRequests $request, $id)
    {
        try {
            $validatedData = collect($request->validated());
            if (!empty($this->apped_save))
                $validatedData->merge($this->apped_save);

            if (!empty($this->serviceClass))
                $model = $this->serviceClass->update($validatedData->toArray(), $id);
            else
                $model = $this->model::where("id", $id)->update($validatedData->toArray());
            if (!$model) {
                throw new \Exception("Error update data");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        if (!empty($this->store_redirect)) {
            $this->thenUpdate($req, $model, $id);
            return redirect($this->store_redirect)->with('success', 'Data successfully updated');
        }

        return redirect()->back()->with('success', 'Data successfully updated');
    }

    #[Get("/destory/{id}")]
    public function destory($id)
    {
        try {

            $model = $this->serviceClass->delete($id);
            if (!$model) {
                throw new \Exception("Error delete data");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        if (!empty($this->store_redirect)) {
            return redirect($this->store_redirect)->with('success', 'Data successfully deleted');
        }

        return redirect()->back()->with('success', 'Data successfully deleted');
    }
}
