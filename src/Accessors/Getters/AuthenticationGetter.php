<?php

namespace OvhSwift\Accessors\Getters;

use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetAuthentication;
use OvhSwift\Accessors\AbstractAccessor;

class AuthenticationGetter extends AbstractAccessor implements IGetAuthentication
{
    public function getAuthentication(): Authentication
    {
        return new Authentication();
    }
}