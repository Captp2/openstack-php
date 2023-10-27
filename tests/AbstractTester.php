<?php

namespace OvhSwift\Tests;

use Faker\Factory;
use Faker\Generator;
use OvhSwift\Domains\Authenticator;
use PHPUnit\Framework\TestCase;

class AbstractTester extends TestCase
{
    protected static Generator $faker;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
        parent::setUpBeforeClass();
    }

    public function tearDown(): void
    {
        $authentication = (new Authenticator())->login();


    }
}