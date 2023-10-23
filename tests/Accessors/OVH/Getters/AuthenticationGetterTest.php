<?php

namespace OvhSwift\Tests\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\AuthenticationGetter;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class AuthenticationGetterTest extends AbstractAccessorTester
{
    protected string $accessorClass = AuthenticationGetter::class;

    /**
     * @var AuthenticationGetter $accessor
     */
    public AbstractAccessor $accessor;

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    public function testICanLoginToCloud(): void
    {
        $authentication = $this->accessor->getAuthentication();
        $this->assertInstanceOf(Authentication::class, $authentication);
        $this->assertIsString($authentication->token);
        $this->assertIsString($authentication->swiftUrl);
    }
}