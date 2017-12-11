<?php namespace App\Repositories;

use App\Entities\TodoList;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use PDO;

class TodoListRepository extends AbstractRepository
{
    /**
     * @param string $name
     * @param int    $userId
     */
    public function create(string $name, int $userId)
    {
        $this->getConnection()->insert(
            TodoListTable::TABLE_NAME,
            [
                'name'    => $name,
                'user_id' => $userId
            ]
        );
    }

    /**
     * @return TodoList[]
     */
    public function search(): array
    {
        $qB = $this->createQueryBuilder();

        $rows = $qB
            ->select(TodoListTable::ENTITY_FIELDS)
            ->from(TodoListTable::TABLE_NAME)
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        return $this->buildEntities($rows);
    }

    /**
     * @param $id
     *
     * @return TodoList
     * @throws RecordNotFoundException
     */
    public function getById($id): TodoList
    {
        $qB = $this->createQueryBuilder();

        $row = $qB
            ->select(TodoListTable::ENTITY_FIELDS)
            ->from(TodoListTable::TABLE_NAME)
            ->where(TodoListTable::FIELD_ID . ' = ' . $qB->createNamedParameter($id))
            ->execute()
            ->fetch(PDO::FETCH_ASSOC);

        if (false === $row)
        {
            throw new RecordNotFoundException('User not found!');
        }

        return $this->buildEntity($row);
    }

    /**
     * @param array $rows
     *
     * @return TodoList[]
     */
    private function buildEntities(array $rows): array
    {
        $entities = [];
        foreach ($rows as $row)
        {
            $entities[] = $this->buildEntity($row);
        }

        return $entities;
    }

    /**
     * @param array $row
     *
     * @return TodoList
     */
    private function buildEntity(array $row): TodoList
    {
        return new TodoList(
            $row[TodoListTable::FIELD_ID],
            $row[TodoListTable::FIELD_NAME]
        );
    }
}
