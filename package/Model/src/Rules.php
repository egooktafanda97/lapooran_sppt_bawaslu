<?php

namespace Package\Model\src;

use Attribute;

#[Attribute]
interface Rules
{
    public function getMessage();
}
