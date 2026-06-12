<?php

namespace App\Enums;

enum EventFormat: string
{
    case PHYSICAL = 'physical';
    case VIRTUAL = 'virtual';
    case HYBRID = 'hybrid';
}
