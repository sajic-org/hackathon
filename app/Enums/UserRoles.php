<?php

namespace App\Enums;

enum UserRoles: string
{
    case USER = 'user';
    case APPRAISER = 'appraiser';
    case COMMISSION = 'commission';
    case ADMIN = 'admin';
}
