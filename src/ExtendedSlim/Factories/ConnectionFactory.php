<?php namespace ExtendedSlim\Factories;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    /**
     * @return Connection
     * @throws DBALException
     */
    public function create()
    {
        return DriverManager::getConnection(
            [
                'dbname'   => getenv('SQL_DBNAME'),
                'user'     => getenv('SQL_USER'),
                'password' => getenv('SQL_PASSWORD'),
                'host'     => getenv('SQL_HOST'),
                'port'     => getenv('SQL_PORT'),
                'driver'   => getenv('SQL_DRIVER'),
            ]
        );
    }
}
