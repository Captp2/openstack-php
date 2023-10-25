<?php

namespace OvhSwift;

use OvhSwift\Exceptions\InvalidConfigException;

require 'vendor/autoload.php';

class App
{
    protected array $config;

    /**
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        $this->config = ConfigLoader::getConfig();

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
    }

    /**
     * @return array
     */
    public function requiredAttributes(): array
    {
        return [];
    }

    /**
     * @param $path
     * @param bool $throwException
     * @return mixed
     * @throws InvalidConfigException
     */
    protected function getOption($path, bool $throwException = true): mixed
    {
        $keys = explode('.', $path);
        return $this->getNestedOption($keys, $this->config, $throwException);
    }

    /**
     * @param array $keys
     * @param array $config
     * @param bool $throwException
     * @return mixed
     * @throws InvalidConfigException
     */
    private function getNestedOption(array $keys, array $config, bool $throwException): mixed
    {
        $key = array_shift($keys);

        if (!isset($config[$key])) {
            if ($throwException) {
                throw new InvalidConfigException("Key {$key} not found in configuration file.");
            } else {
                return null;
            }
        }

        if (empty($keys)) {
            return $config[$key];
        }

        return $this->getNestedOption($keys, $config[$key], $throwException);
    }
}