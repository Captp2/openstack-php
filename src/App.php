<?php

namespace OvhSwift;

use OvhSwift\Exceptions\InvalidConfigException;

require 'vendor/autoload.php';

class App
{
    protected array $config;

    public function __construct()
    {
        $this->config = ConfigLoader::getConfig();
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

        foreach ($keys as $key) {
            if (isset($this->config[$key])) {
                return $this->config[$key];
            } else {
                if ($throwException) {
                    throw new InvalidConfigException("{$path} not found in configuration file.");
                } else {
                    return null;
                }
            }
        }
    }
}