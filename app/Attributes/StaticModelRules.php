<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class StaticModelRules
{
    public $rules;
    public function __construct($models)
    {
        $this->rules = $models::rules();
    }
}
