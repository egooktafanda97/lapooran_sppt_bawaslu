<?php

namespace Package\Attribute;

use Attribute;

#[Attribute]
class SetGet
{
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function getAttribute()
    {
        $inData =  array_merge(get_object_vars($this), ...[...$this->custom]);
        unset($inData['custom']);
        return $inData;
    }
}
