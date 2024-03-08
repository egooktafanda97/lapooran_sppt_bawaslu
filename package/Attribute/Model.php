<?php

namespace Package\Attribute;

use Attribute;

#[Attribute]
class Model
{
    public function __construct(public $model)
    {
    }
}
