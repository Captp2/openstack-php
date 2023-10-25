<?php

namespace OvhSwift\Tests\Accessors;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Tests\AbstractTester;
use PHPUnit\Framework\TestCase;

class AbstractAccessorTester extends AbstractTester
{
    protected string $accessorClass;
    public AbstractAccessor $accessor;

    protected function setUp(): void
    {
        parent::setUp();;
        $this->accessor = new $this->accessorClass();
    }
}