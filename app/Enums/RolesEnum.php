<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case ORGANIZATION = 'organization';
    case EMPLOYEE = 'employee';
}
