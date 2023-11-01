<?php

use OvhSwift\Accessors\OVH\Getters\AuthenticationGetter;
use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Getters\FileGetter;
use OvhSwift\Accessors\OVH\Setters\AuthenticationSetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Accessors\OVH\Setters\FileSetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Domains\ContainerManager;
use OvhSwift\Domains\FileManager;
use OvhSwift\Interfaces\SPI\IUseContainers;
use OvhSwift\Interfaces\SPI\IUseFiles;

$dotenv = Dotenv\Dotenv::createImmutable(getenv('ENV_PATH'));
$dotenv->load();

return [
    'ovh' => [
        'config' => [
            'region' => $_ENV['OVH_REGION'],
            'username' => $_ENV['OVH_USERNAME'],
            'password' => $_ENV['OVH_PASSWORD'],
            'project_id' => $_ENV['OVH_PROJECT_ID'],
            'domain_id' => $_ENV['OVH_DOMAIN'] ?? 'default',
            'protocol' => $_ENV['OVH_PROTOCOL'] ?? 'swift',
            'max_file_size' => $_ENV['MAX_FILE_SIZE'] ?? 262144000
        ],
        'accessors' => [
            Authenticator::class => [
                'getter' => AuthenticationGetter::class,
                'setter' => AuthenticationSetter::class,
            ],
            ContainerManager::class => [
                'getter' => ContainerGetter::class,
                'setter' => ContainerSetter::class,
            ],
            FileManager::class => [
                'getter' => FileGetter::class,
                'setter' => FileSetter::class,
            ]
        ],
        'spi' => [
            FileManager::class => IUseFiles::class,
            ContainerManager::class => IUseContainers::class
        ]
    ]
];