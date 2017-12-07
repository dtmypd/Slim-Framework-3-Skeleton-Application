<?php namespace App\Repositories;

class UserTable
{
    const TABLE_NAME = 'users';

    const FIELD_ID        = 'id';
    const FIELD_USER_NAME = 'user_name';

    const ENTITY_FIELDS = [
        self::FIELD_ID,
        self::FIELD_USER_NAME,
    ];
}
