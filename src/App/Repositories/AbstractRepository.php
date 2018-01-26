<?php namespace App\Repositories;

use ExtendedSlim\Database\Connection;
use ExtendedSlim\Decorators\LoggingQueryBuilder;

abstract class AbstractRepository
{
    /** @var Connection */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @return LoggingQueryBuilder
     */
    protected function createQueryBuilder(): LoggingQueryBuilder
    {
        return $this->connection->createQueryBuilder();
    }
}
