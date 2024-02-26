<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequests;
use Illuminate\Http\Request;
use Package\Attribute\UseValidate;

trait AutoCrud
{
    public $args = [];
    public $Model = "";

    public function view()
    {
        return view(request()->view, $this->args);
    }

    public function json()
    {
        return response()->json($this->args);
    }

    public function store(#[UseValidate(["nama" => "required"])] FormRequests $request)
    {
        return $this;
    }

    public function update()
    {
    }

    public function destory()
    {
    }
}
