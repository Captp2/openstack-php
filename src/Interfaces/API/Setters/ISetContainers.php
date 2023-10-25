<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Entities\Authentication;

Interface ISetContainers
{
    public function createContainer(Authentication $authentication, string $name): bool;

    public function deleteContainer(Authentication $authentication, string $name): bool;
}