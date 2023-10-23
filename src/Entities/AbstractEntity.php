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
        $missingAttributes = [];

        foreach ($this->requiredAttributes() as $requiredAttribute) {
            if (!isset($attributes[$requiredAttribute])) {
                $missingAttributes[] = $requiredAttribute;
            }
        }

        if ($missingAttributes) {
            throw new \InvalidArgumentException('Missing attributes: ' . implode(', ', $missingAttributes));
        }

        if ($attributes) {
            foreach ($attributes as $name => $value) {
                $this->$name = $value;
            }
        }

        parent::__construct();
    }

    /**
     * @return array
     */
    public function requiredAttributes(): array
    {
        return [];
    }
}