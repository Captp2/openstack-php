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

    /**
     * @return string
     */
    private static function getContainerName(): string
    {
        return self::$faker->text(50);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function tearDown(): void
    {
        foreach ($this->containerNames as $containerName) {
            try {
                $this->accessor->deleteContainer($containerName);
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

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICanDeleteAContainer()
    {
        $containerName = self::getContainerName();
        $this->containerNames[] = $containerName;
        $this->accessor->createContainer($containerName);
        $this->assertTrue($this->accessor->deleteContainer($containerName));
        $containerList = (new ContainerGetter(['authentication' => $this->authentication]))->listContainers();

        $containerExists = false;
        foreach ($containerList as $container) {
            if ($container->name === $containerName) {
                $containerExists = true;
            }
        }
        $this->assertFalse($containerExists);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICanCreateAContainer()
    {
        $containerName = self::getContainerName();
        $this->containerNames[] = $containerName;
        $this->assertTrue(
            $this->accessor->createContainer($containerName)
        );

        $containerList = (new ContainerGetter(['authentication' => $this->authentication]))->listContainers();
        $containerCreated = false;
        foreach ($containerList as $container) {
            if ($container->name === $containerName) {
                $containerCreated = true;
            }
        }

        $this->assertTrue($containerCreated);
    }
}