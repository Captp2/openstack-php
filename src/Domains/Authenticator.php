<?php

namespace OvhSwift\Domains;

use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetAuthentication;
use OvhSwift\Interfaces\Setters\ISetAuthentication;
use OvhSwift\Accessors\Getters\AuthenticationGetter;
use OvhSwift\Accessors\Setters\AuthenticationSetter;

class Authenticator extends AbstractDomain
{
    /**
     * @return Authentication
     */
    public function login(): Authentication
    {
        return $this->getter->getAuthentication();
    }

    /**
     * @return string
     */
    protected function getterClass(): string
    {
        return AuthenticationGetter::class;
    }

    /**
     * @return string
     */
    protected function setterClass(): string
    {
        return AuthenticationSetter::class;
    }

    /**
     * @return string
     */
    protected function getterInterface(): string
    {
        return IGetAuthentication::class;
    }

    /**
     * @return string
     */
    protected function setterInterface(): string
    {
        return ISetAuthentication::class;
    }
}