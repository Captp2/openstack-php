<?php

namespace OvhSwift\Tests\Mocks\API\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Interfaces\API\Getters\IGetContainers;

class ContainerGetterMock extends AbstractAccessor implements IGetContainers
{
    public ?array $items = [];

    public function listContainers(): array
    {
        return [];
    }

    public function listItems(string $name): array
    {

    }

    public function containerExists(string $name): bool
    {
        // TODO: Implement containerExists() method.
    }
}