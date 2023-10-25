<?php

namespace OvhSwift\Tests\Accessors\OVH\Getters;

use DateTime;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Domains\Authenticator;
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
    public function testICanListContainers()
    {
        $containers = $this->accessor->listContainers($this->authentication);

        $this->assertCount(2, $containers);
        $this->assertEquals('swift-test-2', $containers[1]->name);
        $this->assertEquals('0', $containers[1]->size);
        $this->assertEquals('0', $containers[1]->itemCount);
        $this->assertInstanceOf(DateTime::class, $containers[0]->lastModified);
    }
}