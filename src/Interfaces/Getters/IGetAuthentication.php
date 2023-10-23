<?php

namespace OvhSwift\Interfaces\Getters;

use OvhSwift\Entities\Authentication;

Interface IGetAuthentication
{
    public function getAuthentication(): Authentication;
}