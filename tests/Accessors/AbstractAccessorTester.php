<?php

namespace OvhSwift\Tests\Accessors;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\AbstractTester;

class AbstractAccessorTester extends AbstractTester
{
    const CONTAINER_NAME = 'swift-test';
    const FILE_NAME = 'Sidonie.jpg';
    const FILE_SIZE = 60692;

    protected string $accessorClass;
    public AbstractAccessor $accessor;
    public Authentication $authentication;

    protected function setUp(): void
    {
        parent::setUp();;
        $this->authentication = (new Authenticator())->login();
        $this->accessor = new $this->accessorClass(['authentication' => $this->authentication]);
    }
}