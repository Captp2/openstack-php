<?php

namespace OvhSwift\Entities;

abstract class AbstractEntity
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->$name = $value;
        }
    }
}