<?php

namespace Package\Attribute;

use Attribute;
use Package\Attribute\SetGet;

#[Attribute(Attribute::TARGET_CLASS)]
class FormRequestAttribute
{

    public const AUTH = true;

    public $flags;

    public function __construct(int $flags = self::AUTH)
    {
        $this->flags = $flags;
    }
}
