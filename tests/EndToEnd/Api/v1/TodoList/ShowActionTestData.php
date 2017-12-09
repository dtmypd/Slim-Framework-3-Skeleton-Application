<?php namespace EndToEnd\Api\v1\TodoList;

use App\Repositories\TodoListTable;
use App\Repositories\UserTable;
use Tests\AbstractTestData;

class ShowActionTestData extends AbstractTestData
{
    public function getInsertedRecord_perfect()
    {
        $this->getConnection()->insert(
            UserTable::TABLE_NAME,
            [
                UserTable::FIELD_ID        => 111,
                UserTable::FIELD_USER_NAME => 'bela',
            ]
        );

        $this->getConnection()->insert(
            TodoListTable::TABLE_NAME,
            [
                TodoListTable::FIELD_ID      => 123,
                TodoListTable::FIELD_USER_ID => 111,
                TodoListTable::FIELD_NAME    => 'todo 123',
            ]
        );
    }
}
