<?php namespace EndToEnd\Api\v1\Todo;

use App\Repositories\TodoTable;
use App\Repositories\UserTable;
use ExtendedSlim\Tests\AbstractTestData;

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
            TodoTable::TABLE_NAME,
            [
                TodoTable::FIELD_ID      => 123,
                TodoTable::FIELD_USER_ID => 111,
                TodoTable::FIELD_NAME    => 'todo 123',
            ]
        );
    }
}
