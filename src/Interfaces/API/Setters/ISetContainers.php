<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Entities\Authentication;

Interface ISetContainers
{
    public function createContainer(string $name): bool;

    public function deleteContainer(string $name): bool;
}