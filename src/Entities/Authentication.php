<?php

namespace OvhSwift\Entities;

class Authentication extends AbstractEntity
{
    public string $token;
    public string $swiftUrl;

    public function requiredAttributes(): array
    {
        return (new \ReflectionClass($this))->getAttributes();
    }
}