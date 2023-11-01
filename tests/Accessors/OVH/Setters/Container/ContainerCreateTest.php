<?php

namespace OvhSwift\Tests\Accessors\OVH\Setters\Container;

use GuzzleHttp\Exception\ClientException;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class ContainerCreateTest extends AbstractAccessorTester
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
    public function testICanCreateAContainer()
    {
        $containerName = self::getContainerName();
        $this->containerNames[] = $containerName;
        $containerCreation = $this->accessor->createContainer($containerName);
        $this->assertTrue($containerCreation->success);

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