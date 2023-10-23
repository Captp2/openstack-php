<?php

namespace OvhSwift\Tests\Mocks\Getters;

use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetAuthentication;
use OvhSwift\Accessors\AbstractAccessor;

class AuthenticationGetterMock extends AbstractAccessor implements IGetAuthentication
{
    const TOKEN = '8Jd2kQ4wXt';
    const CONTAINER_URL = '3ndaao2Dq';

    public function getAuthentication(): Authentication
    {
        return new Authentication(['token' => self::TOKEN, 'containerUrl' => self::CONTAINER_URL]);
    }
}