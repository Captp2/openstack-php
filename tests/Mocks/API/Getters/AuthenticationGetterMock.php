<?php

namespace OvhSwift\Tests\Mocks\API\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Getters\IGetAuthentication;

class AuthenticationGetterMock extends AbstractAccessor implements IGetAuthentication
{
    const TOKEN = '8Jd2kQ4wXt';
    const CONTAINER_URL = '3ndaao2Dq';

    public function getAuthentication(): Authentication
    {
        return new Authentication(['token' => self::TOKEN, 'swiftUrl' => self::CONTAINER_URL]);
    }
}