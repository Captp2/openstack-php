<?php

namespace OvhSwift\Tests\Domains\Container;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\ContainerManager;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\ContainerSetterMock;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;

class ContainerReadTest extends AbstractDomainTester
{
    const TEST_CONTAINER_NAME = 'Marie Heaney';

    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    public function testIcantListItemsFromUnknownContainer()
    {
        $this->assertFalse($this->getDomain(new ContainerUserMock(), new ContainerGetterMock(['exists' => false]))
            ->exists(self::TEST_CONTAINER_NAME));
    }
}