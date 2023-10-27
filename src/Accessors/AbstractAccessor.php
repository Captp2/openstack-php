<?php

namespace OvhSwift\Accessors;

use OvhSwift\App;
use OvhSwift\Entities\Authentication;
use OvhSwift\Traits\Guzzle;

class AbstractAccessor extends App
{
    use Guzzle;

    public $authentication;

    public function setUp()
    {
        $this->initializeGuzzleClient();
    }
}