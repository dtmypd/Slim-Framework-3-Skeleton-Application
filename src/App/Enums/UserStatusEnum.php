<?php namespace App\Enums;

use MabeEnum\Enum;

class UserStatusEnum extends Enum
{
    const INACTIVE = 0;
    const ACTIVE   = 1;
    const DELETED  = 2;
}
