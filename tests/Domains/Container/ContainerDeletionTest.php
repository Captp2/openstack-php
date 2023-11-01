<?php

namespace OvhSwift\Tests\Domains\Container;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\ContainerManager;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\ContainerSetterMock;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;

class ContainerDeletionTest extends AbstractDomainTester
{
    const TEST_CONTAINER_NAME = 'Marie Heaney';

    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    public function testICantDeleteAnUnknownContainer()
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->expectExceptionMessage("Container " . self::TEST_CONTAINER_NAME . "  not found");
        $this->getDomain(new ContainerUserMock(), null, new ContainerSetterMock([
            'deleteResponse' => new AccessorResponse([
                'success' => false,
                'errors' => [
                    '404' => "Container " . self::TEST_CONTAINER_NAME . "  not found"
                ]
            ])
        ]))->deleteContainer(self::TEST_CONTAINER_NAME);
    }
}