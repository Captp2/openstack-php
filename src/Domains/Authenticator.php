<?php

namespace OvhSwift\Domains;

use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetAuthentication;
use OvhSwift\Interfaces\Setters\ISetAuthentication;

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