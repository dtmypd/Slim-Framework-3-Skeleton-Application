<?php namespace App\Repositories;

final class TodoListTable
{
    const TABLE_NAME = 'todo_list';

    const FIELD_ID   = 'id';
    const FIELD_NAME = 'name';

    const ENTITY_FIELDS = [
        self::FIELD_ID,
        self::FIELD_NAME,
    ];
}
