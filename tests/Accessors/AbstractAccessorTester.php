<?php

namespace OvhSwift\Tests\Accessors;

use GuzzleHttp\Exception\ClientException;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\AbstractTester;

class AbstractAccessorTester extends AbstractTester
{
    const CONTAINER_NAME = 'swift-test';
    const FILE_NAME = 'Sidonie.jpg';
    const FILE_SIZE = 60692;

    protected array $containerNames = [];

    protected string $accessorClass;
    public AbstractAccessor $accessor;

    public function setUp(): void
    {
        parent::setUp();
        $this->accessor = new $this->accessorClass(['authentication' => $this->authentication]);
    }
}