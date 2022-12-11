<?php

namespace App\Enums;

enum EmploymentTypeEnum: int
{
    case FULL_TIME = 1;
    case PART_TIME = 2;
    case CONTRACT = 3;
    case TEMPORARY = 4;
    case VOLUNTEER = 5;
    case INTERNSHIP = 6;
}
