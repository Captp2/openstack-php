<?php

namespace OvhSwift\Tests\Accessors;

use OvhSwift\Accessors\AbstractAccessor;
use PHPUnit\Framework\TestCase;

class AbstractAccessorTester extends TestCase
{
    protected string $accessorClass;
    public AbstractAccessor $accessor;

    public function __construct(string $name)
    {
        $this->accessor = new $this->accessorClass();

        return parent::__construct($name);
    }
}