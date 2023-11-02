<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Accessors\AccessorResponse;

Interface ISetContainers
{
    public function createContainer(string $name): AccessorResponse;

    public function deleteContainer(string $name, bool $forceDelete = false): AccessorResponse;
}