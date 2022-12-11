<?php

namespace App\Enums;

enum WorkplaceTypeEnum: int
{
    case ON_SITE = 1;
    case HYBRID = 2;
    case REMOTE = 3;
}
