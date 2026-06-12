<?php

namespace App\Models;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    //convert status and format columns in the DB into PHP objects upon specified in the enum
    protected function casts(): array
    {
        return [
            'status' => PaymentStatus::class,
        ];
    }
}
