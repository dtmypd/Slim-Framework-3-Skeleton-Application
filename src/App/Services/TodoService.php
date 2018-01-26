<?php namespace App\Services;

use App\Controllers\Api\v1\TodoController\ResponseMessageConstants;
use App\Entities\Todo;
use App\ParameterObjects\PagerParameterObject;
use App\Repositories\TodoRepository;
use App\ValueObjects\PaginatedTodoListValueObject;
use ExtendedSlim\Database\Connection;
use Doctrine\DBAL\ConnectionException;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use ExtendedSlim\Http\HttpCodeConstants;
use ExtendedSlim\Http\RestApiResponse;
use Exception;

class TodoService
{
    /** @var TodoRepository */
    private $todoRepository;

    /** @var Connection */
    private $connection;

    /**
     * @param TodoRepository $todoRepository
     * @param Connection     $connection
     */
    public function __construct(TodoRepository $todoRepository, Connection $connection)
    {
        $this->todoRepository = $todoRepository;
        $this->connection     = $connection;
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
            $this->todoRepository->create(new Todo(null, $name, $userId));

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
     * @param int $page
     * @param int $perPage
     *
     * @return RestApiResponse
     * @throws ConnectionException
     */
    public function search(int $page, int $perPage): RestApiResponse
    {
        $this->connection->beginTransaction();
        $todoList  = $this->todoRepository->search(new PagerParameterObject($perPage, ($page - 1) * $perPage));
        $tableRows = $this->todoRepository->getTableRows();
        $this->connection->commit();

        return new RestApiResponse(
            new PaginatedTodoListValueObject($todoList, $this->paginatorBuilder($tableRows, $perPage, $page))
        );
    }

    /**
     * @param int $tableRows
     * @param int $perPage
     * @param int $page
     *
     * @return array
     */
    private function paginatorBuilder(int $tableRows, int $perPage, int $page)
    {
        $lastPage = round($tableRows / $perPage);

        return [
            'tableRows'    => $tableRows,
            'perPage'      => $perPage,
            'currentPage'  => $page,
            'lastPage'     => $lastPage,
            'nextPage'     => $page < $lastPage ? $page + 1 : $lastPage,
            'previousPage' => $page > 1 ? $page - 1 : $page,
        ];
    }

    /**
     * @param integer $id
     *
     * @return RestApiResponse
     */
    public function getById(int $id): RestApiResponse
    {
        try
        {
            return new RestApiResponse($this->todoRepository->getById($id));
        }
        catch (RecordNotFoundException $e)
        {
            return new RestApiResponse(
                ['id' => $id],
                ResponseMessageConstants::TODO_ITEM_ERROR_ID,
                ResponseMessageConstants::TODO_ITEM_ERROR_MESSAGE,
                HttpCodeConstants::BAD_REQUEST
            );
        }
    }
}
