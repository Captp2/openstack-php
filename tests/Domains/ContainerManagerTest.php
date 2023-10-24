<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\ContainerManager;
use OvhSwift\Tests\Mocks\API\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\ContainerSetterMock;

class ContainerManagerTest extends AbstractDomainTester
{
    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    public function testIReceiveAnEmptyArray()
    {
        $this->assertEquals([], $this->getDomain()->listContainers());
    }
}