<?php

namespace OvhSwift\Tests\Accessors\OVH\Setters\Container;

use GuzzleHttp\Exception\ClientException;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class ContainerDeleteTest extends AbstractAccessorTester
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
        $containerDeletion = $this->accessor->deleteContainer($containerName);
        $this->assertTrue($containerDeletion->success);
        $containerList = (new ContainerGetter(['authentication' => $this->authentication]))->listContainers();

        $containerExists = false;
        foreach ($containerList as $container) {
            if ($container->name === $containerName) {
                $containerExists = true;
            }
        }
        $this->assertFalse($containerExists);
    }

    public function testICantDeleteAnUnknownContainer()
    {
        $containerName = self::$faker->text(25);
        $response = $this->accessor->deleteContainer($containerName);

        $this->assertInstanceOf(AccessorResponse::class, $response);
        $this->assertFalse($response->success);
        $this->assertEquals(404, $response->code);
        $this->assertEquals("Container {$containerName} not found", $response->message);
    }
}