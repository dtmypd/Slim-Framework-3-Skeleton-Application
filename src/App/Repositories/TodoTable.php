<?php namespace App\Repositories;

final class TodoTable extends AbstractTable
{
    const TABLE_NAME = 'todo_list';

    const FIELD_ID      = 'id';
    const FIELD_NAME    = 'name';
    const FIELD_USER_ID = 'user_id';

    const ENTITY_FIELDS = [
        self::FIELD_ID,
        self::FIELD_NAME,
        self::FIELD_USER_ID,
    ];
}
