<?php

namespace App\Enums;


enum ItemMenuType: string
{
    case Link = 'link';
    case Page = 'page';
    case Custom = 'custom';
}
