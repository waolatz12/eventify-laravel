<?php

namespace App\Enums;

enum AppointmentStatus: string
{
    CASE PENDING = 'pending';
    CASE CONFIRMED = 'confirmed';
    CASE REJECTED = 'rejected';
    CASE WAITLISTED = 'waitlisted'; //The event or time-slot is at full capacity but you're on queue incase someone cancels their appointment
}
