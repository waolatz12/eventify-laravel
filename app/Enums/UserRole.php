<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin' || 'Admin';
    case ORGANIZER = 'organizer';
    case ATTENDEE = 'attendee';
    case VENDOR = 'vendor';
}
