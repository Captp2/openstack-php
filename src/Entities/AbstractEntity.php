<?php

namespace OvhSwift\Entities;

use OvhSwift\App;

abstract class AbstractEntity extends App
{
    /**
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        if ($attributes) {
            foreach ($attributes as $name => $value) {
                $this->$name = $value;
            }
        }
    }
}