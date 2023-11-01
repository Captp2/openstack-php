<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Entities\Authentication;

Interface ISetContainers
{
    public function createContainer(string $name): AccessorResponse;

    public function deleteContainer(string $name): AccessorResponse;
}