<?php

namespace OvhSwift\Tests\Accessors\OVH\Getters;

use DateTime;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class ContainerManagerGetterTest extends AbstractAccessorTester
{
    protected string $accessorClass = ContainerGetter::class;

    /**
     * @var ContainerGetter
     */
    public AbstractAccessor $accessor;

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICanListContainers(): void
    {
        $containers = $this->accessor->listContainers();

        $this->assertCount(2, $containers);
        $this->assertEquals('swift-test-2', $containers[1]->name);
        $this->assertEquals('60692', $containers[1]->size);
        $this->assertEquals('1', $containers[1]->itemCount);
        $this->assertInstanceOf(DateTime::class, $containers[0]->lastModified);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testICanListContainerItems(): void
    {
        $files = $this->accessor->listItems('swift-test');

        $this->assertCount(1, $files);
        $file = $files[0];
        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals('Sidonie.jpg', $file->name);
        $this->assertEquals('60692', $file->size);
        $this->assertEquals('image/jpeg', $file->mimeType);
    }

    public function testICantListItemsFromUnknownContainer()
    {
        $containerName = self::$faker->name(50);
        $this->expectException(RessourceNotFoundException::class);
        $this->expectExceptionMessage("Container {$containerName} not found");
        $this->accessor->listItems($containerName);
    }
}