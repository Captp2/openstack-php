<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domain\ContainerManager;
use OvhSwift\Providers\AbstractAccessor;
use OvhSwift\Tests\Mocks\ContainerGetterMock;
use OvhSwift\Tests\Mocks\ContainerSetterMock;

class ContainerManagerTest extends AbstractDomainTester
{
    private string $domainName = ContainerManager::class;

    function getDomainName(): string
    {
        return $this->domainName;
    }

    public function testIReceiveAnEmptyArray()
    {
        $this->assertEquals([], $this->domain->listContainers());
    }

    function getGetter(): AbstractAccessor
    {
        return new ContainerGetterMock();
    }

    function getSetter(): AbstractAccessor
    {
        return new ContainerSetterMock();
    }
}