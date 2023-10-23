<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\ContainerManager;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\Mocks\Getters\AuthenticationGetterMock;
use OvhSwift\Tests\Mocks\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\Setters\ContainerSetterMock;

class ContainerManagerTest extends AbstractDomainTester
{
    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    public function testIReceiveAnEmptyArray()
    {
        $this->assertEquals([], $this->domain->listContainers());
    }
}