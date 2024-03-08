<?php

namespace App\Http\Controllers;

use App\Attributes\Contract\ReflectionMeta;
use App\Attributes\Propertis;
use App\Http\Requests\FormRequests;
use Illuminate\Http\Request;
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
        $this->model =  $props->MainModel;
        $this->store_redirect = $props->store_redirect;

        if (!empty($props->Service)) {
            $this->serviceClass = new $props->Service();
        }

        app()->bind(FormRequests::class, function ($app) use ($props) {
            $instace_model = $props->MainModel::rules();
            return new FormRequests($instace_model);
        });
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
        $Items = $this->model::all();
        if (!empty($this->serviceClass)) {
            $Items =  $this->serviceClass->all();
        }

        return ["Items" => $Items, ...$this->dataView];
    }

    #[Get("/create", middleware: "web")]
    public function create(Request $request)
    {
        return view($request->view);
    }

    #[Post("/store")]
    public function store(FormRequests $request)
    {
        try {
            $validatedData = collect($request->validated());
            if (!empty($this->apped_save))
                $validatedData->merge($this->apped_save);
            $model = $this->serviceClass->create($validatedData->toArray());
            if (!$model) {
                throw new \Exception("Error saving data");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        if (!empty($this->store_redirect)) {
            return redirect($this->store_redirect)->with('success', 'Data successfully saved');
        }

        return redirect()->back()->with('success', 'Data successfully saved');
    }

    #[Post("/update/{id}")]
    public function update(FormRequests $request, $id)
    {
        try {
            $validatedData = collect($request->validated());
            if (!empty($this->apped_save))
                $validatedData->merge($this->apped_save);
            $model = $this->serviceClass->update($validatedData->toArray(), $id);
            if (!$model) {
                throw new \Exception("Error update data");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        if (!empty($this->store_redirect)) {
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
