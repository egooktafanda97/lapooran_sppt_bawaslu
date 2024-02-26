<?php

namespace Package\Model;

use Package\Model\src\impl\ModelAttributesImpl;
use Package\Model\src\impl\RulesImpl;
use Package\Model\src\ModelAttributes;
use Package\Model\src\Rules;

class ServiceProviders
{
    public function __construct()
    {
        app()->bind(ModelAttributes::class, ModelAttributesImpl::class);
        app()->bind(Rules::class, RulesImpl::class);
    }
}
