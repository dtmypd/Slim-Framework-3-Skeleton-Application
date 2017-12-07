<?php namespace Integration\Repositories;

use App\Repositories\UserTable;
use Integration\AbstractIntegrationTestData;

class TodoListRepositoryTestData extends AbstractIntegrationTestData
{
    public function create_insertNewTodo_Perfect()
    {
        $this->getConnection()->insert(
            UserTable::TABLE_NAME,
            [
                UserTable::FIELD_ID        => 1,
                UserTable::FIELD_USER_NAME => 'bela',
            ]
        );
    }
}
