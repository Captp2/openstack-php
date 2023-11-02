<?php

namespace OvhSwift\Tests\Accessors\OVH\Setters\Container;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Getters\FileGetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Accessors\OVH\Setters\FileSetter;
use OvhSwift\Entities\File;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class ContainerDeleteTest extends AbstractAccessorTester
{
    protected string $accessorClass = ContainerSetter::class;

    /**
     * @return string
     */
    private static function getContainerName(): string
    {
        return self::$faker->text(50);
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

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICantDeleteAFullContainer(): void
    {
        $containerName = self::$faker->text(25);
        (new FileSetter(['authentication' => $this->authentication]))
            ->uploadFile($containerName, self::FILE_NAME, self::FILE_PATH, true);

        $response = $this->accessor->deleteContainer($containerName);
        $this->assertInstanceOf(AccessorResponse::class, $response);
        $this->assertFalse($response->success);
        $this->assertEquals(409, $response->code);
        $this->assertEquals("Container {$containerName} is not empty", $response->message);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICanForceDeleteAFullContainer(): void
    {
        $containerName = self::$faker->text(25);
        (new FileSetter(['authentication' => $this->authentication]))
            ->uploadFile($containerName, self::FILE_NAME, self::FILE_PATH, true);

        $file = (new FileGetter(['authentication' => $this->authentication]))
            ->getFileByName($containerName, self::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);

        $response = $this->accessor->deleteContainer($containerName, true);
        $this->assertTrue($response->success);
    }
}