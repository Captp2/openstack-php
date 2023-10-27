<?php

namespace OvhSwift\Tests\Mocks\API\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Getters\IGetContainers;

class ContainerGetterMock extends AbstractAccessor implements IGetContainers
{
    public function listContainers(Authentication $authentication): array
    {
        return [];
    }

    public function listItems(Authentication $authentication, string $name): array
    {
        // TODO: Implement listItems() method.
    }
}