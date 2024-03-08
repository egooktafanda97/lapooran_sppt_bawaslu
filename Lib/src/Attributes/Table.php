<?php

namespace Lib\src\Attributes;

use Attribute;

#[Attribute]
class Table
{
    public function __construct(public $table)
    {
    }
}
