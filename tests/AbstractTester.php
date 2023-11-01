<?php

namespace OvhSwift\Tests;

use Faker\Factory;
use Faker\Generator;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Domains\ContainerManager;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\Mocks\SPI\ContainerUserMock;
use PHPUnit\Framework\TestCase;
use function Sodium\randombytes_uniform;

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