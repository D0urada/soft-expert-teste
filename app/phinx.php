<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/src/Database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/src/Database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'pgsql',
            'host' => $_ENV['POSTGRES_HOST'],
            'name' => $_ENV['POSTGRES_DB'],
            'user' => $_ENV['POSTGRES_USER'],
            'pass' => $_ENV['POSTGRES_PASSWORD'],
            'port' => $_ENV['POSTGRES_PORT'],
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'pgsql',
            'host' => $_ENV['POSTGRES_HOST'],
            'name' => $_ENV['POSTGRES_DB'],
            'user' => $_ENV['POSTGRES_USER'],
            'pass' => $_ENV['POSTGRES_PASSWORD'],
            'port' => $_ENV['POSTGRES_PORT'],
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'pgsql',
            'host' => $_ENV['POSTGRES_HOST'],
            'name' => $_ENV['POSTGRES_DB'],
            'user' => $_ENV['POSTGRES_USER'],
            'pass' => $_ENV['POSTGRES_PASSWORD'],
            'port' => $_ENV['POSTGRES_PORT'],
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
