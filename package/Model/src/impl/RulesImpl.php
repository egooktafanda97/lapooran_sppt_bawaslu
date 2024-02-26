<?php

namespace Package\Model\src\impl;

use Attribute;
use Package\Model\src\Rules;

#[Attribute]
class RulesImpl implements Rules
{
    public function __construct()
    {
    }
    public function getMessage()
    {
        return "ok";
    }
}
