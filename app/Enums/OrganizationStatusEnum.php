<?php

namespace App\Enums;

enum OrganizationStatusEnum: int
{
    case ACTIVE = 10;
    case DISABLED = 0;
    case NEW = 1;
}
