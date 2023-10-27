<?php

namespace OvhSwift\Interfaces\API\Getters;

use OvhSwift\Entities\Authentication;

Interface IGetContainers
{
    public function listContainers(Authentication $authentication): array;

    public function listItems(Authentication $authentication, string $name): array;
}