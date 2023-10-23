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

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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
        ]
    ]
];