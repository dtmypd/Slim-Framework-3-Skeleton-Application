<?php namespace App\Services;

use App\Controllers\Api\v1\TodoListController\ResponseMessageConstants;
use App\Entities\TodoList;
use App\Repositories\TodoListRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ConnectionException;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\RestApiResponse;
use Exception;

class TodoListService
{
    /** @var TodoListRepository */
    private $todoListRepository;

    /** @var Connection */
    private $connection;

    /**
     * @param TodoListRepository $todoListRepository
     * @param Connection         $connection
     */
    public function __construct(TodoListRepository $todoListRepository, Connection $connection)
    {
        $this->todoListRepository = $todoListRepository;
        $this->connection         = $connection;
    }

    /**
     * @param string $name
     * @param int    $userId
     *
     * @return RestApiResponse
     * @throws ConnectionException
     */
    public function create(string $name, int $userId)
    {
        $this->connection->beginTransaction();

        try
        {
            $this->todoListRepository->create($name, $userId);

            $this->connection->commit();

            return new RestApiResponse();
        }
        catch (Exception $e)
        {
            $this->connection->rollBack();

            return new RestApiResponse(
                null,
                ResponseMessageConstants::UNKNOWN_ERROR_ID,
                ResponseMessageConstants::UNKNOWN_ERROR_MESSAGE,
                HttpCodeConstants::BAD_REQUEST
            );
        }
    }

    /**
     * @return TodoList[]
     */
    public function search(): array
    {
        return $this->todoListRepository->search();
    }

    /**
     * @param integer $id
     *
     * @return TodoList
     * @throws RecordNotFoundException
     */
    public function getById(int $id): TodoList
    {
        return $this->todoListRepository->getById($id);
    }
}
