<?php

namespace OvhSwift\Tests\Accessors\OVH\Setters;

use GuzzleHttp\Exception\ClientException;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class ContainerManagerSetterTest extends AbstractAccessorTester
{
    protected string $accessorClass = ContainerSetter::class;

    private array $containerNames = [];

    private static function getContainerName()
    {
        return self::$faker->text(50);
    }

    public function tearDown(): void
    {
        foreach ($this->containerNames as $containerName) {
            try {
                $this->accessor->deleteContainer($this->authentication, $containerName);
            } catch (ClientException $e) {
                if (!$e->getCode() == 404) {
                    throw $e;
                }
            }
        }
    }

    /**
     * @var ContainerSetter $accessor
     */
    public AbstractAccessor $accessor;

    public function testICanDeleteAContainer()
    {
        $containerName = self::getContainerName();
        $this->containerNames[] = $containerName;
        $this->accessor->createContainer($this->authentication, $containerName);
        $this->assertTrue($this->accessor->deleteContainer($this->authentication, $containerName));
        $containerList = (new ContainerGetter())->listContainers($this->authentication);

        $containerExists = false;
        foreach ($containerList as $container) {
            if ($container->name === $containerName) {
                $containerExists = true;
            }
        }
        $this->assertFalse($containerExists);
    }

    public function testICanCreateAContainer()
    {
        $containerName = self::getContainerName();
        $this->containerNames[] = $containerName;
        $this->assertTrue(
            $this->accessor->createContainer($this->authentication, $containerName)
        );

        $containerList = (new ContainerGetter())->listContainers($this->authentication);
        $containerCreated = false;
        foreach ($containerList as $container) {
            if ($container->name === $containerName) {
                $containerCreated = true;
            }
        }

        $this->assertTrue($containerCreated);
    }
}