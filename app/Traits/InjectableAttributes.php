<?php

namespace App\Traits;

trait InjectableAttributes
{
    public $injectedAttributes;

    public function __call($name, $arguments)
    {
        if (method_exists($this->injectedAttributes, $name)) {
            return $this->injectedAttributes->{$name}(...$arguments);
        } else {
            return parent::__call($name, $arguments);
        }
    }
}
