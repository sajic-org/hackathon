<?php

namespace App\Enums;

enum UserRoles :string
{
    case USER = 'user';
    case APPRAISER = 'appraiser';
    case COMISSION = 'comission';
    case ADMIN = 'admin';
}
