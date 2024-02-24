<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Pending = '0';
    case Active = '1';
    case Inactive = '2';
}
