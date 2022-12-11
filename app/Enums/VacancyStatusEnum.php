<?php

namespace App\Enums;

enum VacancyStatusEnum: int
{
    case ACTIVE = 10;
    case DRAFT = 5;
    case DISABLED = 0;
    case NEW = 1;
}
