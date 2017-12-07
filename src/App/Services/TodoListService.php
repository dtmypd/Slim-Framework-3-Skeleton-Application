<?php namespace App\Services;

use App\Entities\TodoList;
use App\Repositories\TodoListRepository;
use ExtendedSlim\Exceptions\RecordNotFoundException;

class TodoListService
{
    /** @var TodoListRepository */
    private $todoListRepository;

    /**
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(TodoListRepository $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * @param string $name
     * @param int    $userId
     */
    public function create(string $name, int $userId)
    {
        $this->todoListRepository->create($name, $userId);
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
