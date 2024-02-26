<?php

namespace  Package\Utilities;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;


class ReflectionExtractor
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function extractClassAttributes()
    {
        $reflection = new ReflectionClass($this->class);
        $attributes = $reflection->getAttributes();

        $extractedAttributes = [];

        foreach ($attributes as $attribute) {
            $extractedAttributes[] = [
                'name' => $attribute->getName(),
                'arguments' => $attribute->getArguments(),
            ];
        }

        return $extractedAttributes;
    }

    public function extractPropertiesWithAttributes()
    {
        $reflection = new \ReflectionClass($this->class);
        $properties = $reflection->getProperties();

        $extractedProperties = [];

        foreach ($properties as $property) {
            $attributes = $property->getAttributes();
            if (!empty($attributes)) {
                $property->setAccessible(true); // Allow access to protected or private properties
                $extractedProperties[] = [
                    'name' => $property->getName(),
                    'visibility' => $this->getPropertyVisibility($property),
                    'static' => $property->isStatic(),
                    'default' => $property->getValue($reflection->newInstanceWithoutConstructor()),
                    'attributes' => $this->extractAttributes($attributes),
                ];
            }
        }

        return $extractedProperties;
    }

    public function extractMethodsWithAttributes()
    {
        $reflection = new \ReflectionClass($this->class);
        $methods = $reflection->getMethods();

        $extractedMethods = [];

        foreach ($methods as $method) {
            $attributes = $method->getAttributes();
            if (!empty($attributes)) {
                $method->setAccessible(true); // Allow access to protected or private methods
                if (!$method->isConstructor() && !$method->isDestructor()) {
                    $extractedMethods[] = [
                        'name' => $method->getName(),
                        'visibility' => $this->getMethodVisibility($method),
                        'static' => $method->isStatic(),
                        'parameters' => $this->getMethodParameters($method),
                        'attributes' => $this->extractAttributes($attributes),
                    ];
                }
            }
        }

        return $extractedMethods;
    }

    protected function getPropertyVisibility(\ReflectionProperty $property)
    {
        if ($property->isPublic()) {
            return 'public';
        } elseif ($property->isProtected()) {
            return 'protected';
        } elseif ($property->isPrivate()) {
            return 'private';
        }
    }

    protected function getMethodVisibility(\ReflectionMethod $method)
    {
        if ($method->isPublic()) {
            return 'public';
        } elseif ($method->isProtected()) {
            return 'protected';
        } elseif ($method->isPrivate()) {
            return 'private';
        }
    }

    protected function getMethodParameters(\ReflectionMethod $method)
    {
        $parameters = $method->getParameters();
        $extractedParameters = [];

        foreach ($parameters as $parameter) {
            $extractedParameters[] = [
                'name' => $parameter->getName(),
                'type' => $this->getParameterType($parameter),
                'default' => $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null,
            ];
        }

        return $extractedParameters;
    }

    protected function getParameterType($parameter)
    {
        if ($parameter->hasType()) {
            return $parameter->getType()->getName();
        }
        return null;
    }

    protected function extractAttributes($attributes)
    {
        $extractedAttributes = [];
        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            $rgs = [];
            try {
                $rgs = $instance->getAttribute();
            } catch (\Throwable $th) {
                $rgs = $attribute->getArguments();
            }
            $extractedAttributes[] = [
                'name' => $attribute->getName(),
                'arguments' =>  $rgs ?? [],
            ];
        }

        return $extractedAttributes;
    }
}
