<?php

namespace OvhSwift\Interfaces\API\Getters;

use OvhSwift\Entities\Authentication;

Interface IGetContainers
{
    public function listContainers(): array;

    public function listItems(string $name): ?array;
}