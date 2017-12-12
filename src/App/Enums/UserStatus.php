<?php namespace App\Enums;

use MabeEnum\Enum;

class UserStatus extends Enum
{
    const INACTIVE = 0;
    const ACTIVE   = 1;
    const DELETED  = 2;
}
