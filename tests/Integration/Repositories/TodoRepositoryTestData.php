<?php namespace Integration\Repositories;

use App\Repositories\UserTable;
use Tests\AbstractTestData;

class TodoRepositoryTestData extends AbstractTestData
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
