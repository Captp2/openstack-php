<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\Authentication;
use OvhSwift\Tests\Mocks\Getters\AuthenticationGetterMock;
use OvhSwift\Tests\Mocks\Setters\AuthenticationSetterMock;

class AuthenticatorTest extends AbstractDomainTester
{
    protected string $domainName = Authenticator::class;
    protected string $getterClass = AuthenticationGetterMock::class;
    protected string $setterClass = AuthenticationSetterMock::class;

    function getDomainName(): string
    {
        return $this->domainName;
    }

    public function testIReceiveAToken()
    {
        $authentication = $this->domain->login();
        $this->assertTrue($authentication instanceof Authentication);
        $this->assertEquals(AuthenticationGetterMock::TOKEN, $authentication->token);
    }
}