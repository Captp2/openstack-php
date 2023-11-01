<?php

namespace OvhSwift\Tests\Domains\Container;

use OvhSwift\Domains\ContainerManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\OpenStackException;
use OvhSwift\Exceptions\ResourceValidationException;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\ContainerGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\ContainerSetterMock;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;

class ContainerCreationTest extends AbstractDomainTester
{
    const TEST_CONTAINER_NAME = 'Marie Heaney';

    protected string $domainName = ContainerManager::class;
    protected string $getterClass = ContainerGetterMock::class;
    protected string $setterClass = ContainerSetterMock::class;

    public function testICantCreateAnInvalidNamedContainer()
    {
        $this->expectException(ResourceValidationException::class);
        $this->expectExceptionMessage(self::TEST_CONTAINER_NAME . " is not a valid container name");
        $this->getDomain(new ContainerUserMock(['validateContainerName' => false]))
            ->createContainer(self::TEST_CONTAINER_NAME);
    }

    public function testICantCreateAnOversizedContainer()
    {
        $this->expectException(OpenStackException::class);
        $this->expectExceptionMessage("Container name must not be greater than " . File::MAX_NAME_SIZE);
        $this->getDomain(new ContainerUserMock())->createcontainer(self::$faker->regexify('[A-Za-z0-9]{' . 257 . '}'));
    }
}