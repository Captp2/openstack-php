<?php

namespace OvhSwift\Entities;

class Authentication extends AbstractEntity
{
    public string $token;
    public string $containerUrl;

    public function requiredAttributes(): array
    {
        return (new \ReflectionClass($this))->getAttributes();
    }
}