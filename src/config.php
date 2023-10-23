<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'ovh' => [
        'username' => $_ENV['OVH_USERNAME'],
        'password' => $_ENV['OVH_PASSWORD'],
        'project_id' => $_ENV['OVH_PROJECT_ID'],
        'domain_id' => $_ENV['OVH_DOMAIN'] ?? 'default',
    ]
];