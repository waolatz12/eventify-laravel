<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\RegistrationStatus;

class Registration extends Model
{
    protected $guarded = [];

    //convert status and format columns in the DB into PHP objects upon specified in the enum
    protected function casts(): array
    {
        return [
            'status' => RegistrationStatus::class,
        ];
    }
}
