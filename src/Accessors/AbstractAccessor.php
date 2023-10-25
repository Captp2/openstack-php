<?php

namespace OvhSwift\Accessors;

use OvhSwift\App;
use OvhSwift\Traits\Guzzle;

class AbstractAccessor extends App
{
    use Guzzle;

    public function setUp()
    {
        $this->initializeGuzzleClient();
    }
}