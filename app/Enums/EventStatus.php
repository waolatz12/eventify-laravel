<?php

namespace App\Enums;

//backed enums
enum EventStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
