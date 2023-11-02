<?php

namespace OvhSwift\Tests\Domains\Container;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\ContainerManager;
use OvhSwift\Exceptions\OpenStackException;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\ContainerSetterMock;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;

class ContainerDeletionTest extends AbstractDomainTester
{
    const TEST_CONTAINER_NAME = 'Marie Heaney';

    /**
     * @var ContainerManager
     */
    protected AbstractDomain $domain;

    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    /**
     * @return void
     */
//    public function testICantDeleteAnUnknownContainer(): void
//    {
//        $this->expectException(ResourceNotFoundException::class);
//        $this->expectExceptionMessage("Container " . self::TEST_CONTAINER_NAME . "  not found");
//        $this->getDomain(new ContainerUserMock(), null, new ContainerSetterMock([
//            'deleteResponse' => new AccessorResponse([
//                'success' => false,
//                'errors' => [
//                    '404' => "Container " . self::TEST_CONTAINER_NAME . "  not found"
//                ]
//            ])
//        ]))->deleteContainer(self::TEST_CONTAINER_NAME);
//    }

    /**
     * @return void
     */
    public function testICantDeleteAFullContainer(): void
    {
        $this->expectException(OpenStackException::class);
        $this->expectExceptionMessage("Container " . self::CONTAINER_NAME . " is not empty");
        $this->getDomain(new ContainerUserMock(), null, new ContainerSetterMock([
            'deleteResponse' => new AccessorResponse([
                'success' => false,
                'errors' => [
                    '409' => "Container " . self::CONTAINER_NAME . " is not empty"
                ]
            ])
        ]))->deleteContainer(self::CONTAINER_NAME);
    }
}