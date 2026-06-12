<?php

namespace App\Enums;

enum BoothStatus: string
{
    CASE AVAILABLE = 'available';
    CASE RESERVED = 'reserved';
    CASE OCCUPIED = 'occupied';
    CASE CANCELED = 'canceled';
}
