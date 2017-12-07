<?php

use ExtendedSlim\App\Config;

try
{
    $minusEPosition = array_search('-e', $_SERVER['argv']);
    $env            = $_SERVER['argv'][$minusEPosition + 1];

    $dotenvFile = '';
    if ('test' === $env)
    {
        $dotenvFile = '.env.test';
    }
}
catch (Exception $e)
{
    $dotenvFile = '';
}

(new Config())->envSetup($dotenvFile);

return [
    'paths'        => [
        'migrations' => __DIR__ . '/db/migrations',
        'seeds'      => __DIR__ . '/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'dev',
        'prod'                    => [
            'adapter' => getenv('SQL_PDO_DRIVER'),
            'host'    => getenv('SQL_HOST'),
            'name'    => getenv('SQL_DBNAME'),
            'user'    => getenv('SQL_USER'),
            'pass'    => getenv('SQL_PASSWORD'),
            'port'    => getenv('SQL_PORT'),
            'charset' => 'utf8',
        ],
        'dev'                     => [
            'adapter' => getenv('SQL_PDO_DRIVER'),
            'host'    => getenv('SQL_HOST'),
            'name'    => getenv('SQL_DBNAME'),
            'user'    => getenv('SQL_USER'),
            'pass'    => getenv('SQL_PASSWORD'),
            'port'    => getenv('SQL_PORT'),
            'charset' => 'utf8',
        ],
        'test'                    => [
            'adapter' => getenv('SQL_PDO_DRIVER'),
            'host'    => getenv('SQL_HOST'),
            'name'    => getenv('SQL_DBNAME'),
            'user'    => getenv('SQL_USER'),
            'pass'    => getenv('SQL_PASSWORD'),
            'port'    => getenv('SQL_PORT'),
            'charset' => 'utf8',
        ],
        'version_order'           => 'creation'
    ]
];
