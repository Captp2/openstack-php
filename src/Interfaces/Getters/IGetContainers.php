<?php

namespace OvhSwift\Interfaces\Getters;

use OvhSwift\Entities\Authentication;

Interface IGetContainers
{
    public function listContainers(Authentication $authentication): array;
}