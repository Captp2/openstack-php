<?php

namespace OvhSwift\Interfaces\API\Getters;

Interface IGetContainers
{
    public function listContainers(): array;

    public function listItems(string $name): ?array;

    public function containerExists(string $name): bool;
}