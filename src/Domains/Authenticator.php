<?php

namespace OvhSwift\Domains;

use OvhSwift\Accessors\OVH\Getters\AuthenticationGetter;
use OvhSwift\Entities\Authentication;

class Authenticator
{
    private static $auth = null;

    /**
     * @return Authentication
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    public static function login($authenticationGetter = null): Authentication
    {
        if (self::$auth === null) {
            $authenticationGetter = $authenticationGetter ?? new AuthenticationGetter();
            self::$auth = $authenticationGetter->getAuthentication();
        }

        return self::$auth;
    }
}