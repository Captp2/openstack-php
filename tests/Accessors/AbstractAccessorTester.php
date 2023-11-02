<?php

namespace OvhSwift\Tests\Accessors;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Tests\AbstractTester;

class AbstractAccessorTester extends AbstractTester
{
    protected string $accessorClass;
    public AbstractAccessor $accessor;

    public function setUp(): void
    {
        parent::setUp();
        $this->accessor = new $this->accessorClass(['authentication' => $this->authentication]);
    }
}