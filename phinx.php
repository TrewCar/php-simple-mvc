<?php
return
[
    'paths' => [
        'migrations' => __DIR__ . '/src/db/migrations',
        'seeds' => __DIR__ . '/src/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8'
        ],
    ],
    'version_order' => 'creation'
];
