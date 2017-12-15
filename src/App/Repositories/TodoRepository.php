<?php namespace App\Repositories;

use App\Entities\Todo;
use App\ParameterObjects\PagerParameterObject;
use ExtendedSlim\Exceptions\RecordNotFoundException;
use PDO;

class TodoRepository extends AbstractRepository
{
    /**
     * @param Todo $todo
     */
    public function create(Todo $todo)
    {
        $this->getConnection()->insert(
            TodoTable::TABLE_NAME,
            [
                'name'    => $todo->getName(),
                'user_id' => $todo->getUserId()
            ]
        );
    }

    /**
     * @param PagerParameterObject $pagerParameterObject
     *
     * @return Todo[]
     */
    public function search(PagerParameterObject $pagerParameterObject): array
    {
        $qB = $this->createQueryBuilder();

        $rows = $qB
            ->select(TodoTable::ENTITY_FIELDS)
            ->from(TodoTable::TABLE_NAME)
            ->setMaxResults($pagerParameterObject->getLimit())
            ->setFirstResult($pagerParameterObject->getOffset())
            ->execute()
            ->fetchAll(PDO::FETCH_ASSOC);

        return $this->buildEntities($rows);
    }

    /**
     * @param $id
     *
     * @return Todo
     * @throws RecordNotFoundException
     */
    public function getById($id): Todo
    {
        $qB = $this->createQueryBuilder();

        $row = $qB
            ->select(TodoTable::ENTITY_FIELDS)
            ->from(TodoTable::TABLE_NAME)
            ->where(TodoTable::FIELD_ID . ' = ' . $qB->createNamedParameter($id))
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
     * @return Todo[]
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
     * @return Todo
     */
    private function buildEntity(array $row): Todo
    {
        return new Todo(
            $row[TodoTable::FIELD_ID],
            $row[TodoTable::FIELD_NAME],
            $row[TodoTable::FIELD_USER_ID]
        );
    }
}
