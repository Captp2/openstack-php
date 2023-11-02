<?php

namespace OvhSwift\Tests;

use Faker\Factory;
use Faker\Generator;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use PHPUnit\Framework\TestCase;

class AbstractTester extends TestCase
{
    protected static Generator $faker;

    public Authentication $authentication;

    public function setUp(): void
    {
        $this->authentication = (new Authenticator())->login();
        parent::setUp();
    }

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
        parent::setUpBeforeClass();
    }
}