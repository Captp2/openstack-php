<?php

namespace OvhSwift\Tests\Mocks\API\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Interfaces\API\Getters\IGetContainers;

class ContainerGetterMock extends AbstractAccessor implements IGetContainers
{
    public ?array $items = [];
    public bool $exists = true;

    public function listContainers(): array
    {
        return [];
    }

    public function listItems(string $name): array
    {
        return $this->items;
    }

    public function containerExists(string $name): bool
    {
        return $this->exists;
    }
}