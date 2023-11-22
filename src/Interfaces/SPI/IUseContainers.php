<?php

namespace OvhSwift\Interfaces\SPI;

interface IUseContainers
{
    public function validateContainerName(string $containerName): bool;
}