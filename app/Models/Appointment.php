<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    protected $guarded = [];

    //convert status and format columns in the DB into PHP objects upon specified in the enum
    protected function casts(): array
    {
        return [
            'status' => AppointmentStatus::class,
        ];
    }
}
