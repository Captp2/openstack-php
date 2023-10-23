<?php

namespace OvhSwift;

class ConfigLoader
{
    private static ?array $config = null;

    public static function getConfig(): array
    {
        if (self::$config === null) {
            self::$config = require(__DIR__ . '/config.php');
        }

        return self::$config;
    }
}