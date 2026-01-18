<?php

namespace App\Enums;

enum UserRoles: string
{
    case PARTICIPANT = 'participant';
    case APPRAISER = 'appraiser';
    case COMMISSION = 'commission';
    case ADMIN = 'admin';
}
