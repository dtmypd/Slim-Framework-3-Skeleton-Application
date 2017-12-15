<?php namespace App\ValueObjects;

use App\Entities\Todo;
use JsonSerializable;

class PaginatedTodoListValueObject implements JsonSerializable
{
    /** @var Todo[] */
    private $todoList;

    /** @var array */
    private $paginator;

    /**
     * @param Todo[] $todoList
     * @param array  $paginator
     */
    public function __construct(array $todoList, array $paginator)
    {
        $this->todoList  = $todoList;
        $this->paginator = $paginator;
    }

    /**
     * @return Todo[]
     */
    public function getTodoList(): array
    {
        return $this->todoList;
    }

    /**
     * @return array
     */
    public function getPaginator(): array
    {
        return $this->paginator;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'todoList'  => $this->getTodoList(),
            'paginator' => $this->getPaginator(),
        ];
    }
}
