<?php

namespace OvhSwift\Interfaces\API\Getters;

use OvhSwift\Entities\Authentication;

Interface IGetAuthentication
{
    public function getAuthentication(): Authentication;
}