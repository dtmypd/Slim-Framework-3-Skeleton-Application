<?php namespace Integration;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;

abstract class AbstractIntegrationTestData
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
     * @return QueryBuilder
     */
    protected function createQueryBuilder()
    {
        return $this->connection->createQueryBuilder();
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }
}
