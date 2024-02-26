<?php

namespace Package\Attribute;

use Attribute;
use Package\Attribute\SetGet;

#[Attribute]
class UseValidate
{
    public function __construct(public array $rules)
    {
        //
    }
}
