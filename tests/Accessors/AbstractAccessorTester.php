<?php

namespace OvhSwift\Tests\Accessors;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\AbstractTester;

class AbstractAccessorTester extends AbstractTester
{
    protected string $accessorClass;
    public AbstractAccessor $accessor;
    public Authentication $authentication;

    protected function setUp(): void
    {
        parent::setUp();;
        $this->authentication = (new Authenticator())->login();
        $this->accessor = new $this->accessorClass();
    }
}