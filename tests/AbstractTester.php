<?php

namespace OvhSwift\Tests;

use Faker\Factory;
use Faker\Generator;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use PHPUnit\Framework\TestCase;

class AbstractTester extends TestCase
{
    const FILE_SIZE = 60692;
    const CONTAINER_NAME = 'swift-test-2';
    const FILE_NAME = 'Sidonie2.jpg';
    const FILE_PATH = __DIR__ . '/../Utils/Sidonie2.jpg';
    const MIME_TYPE = 'image/jpeg';

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