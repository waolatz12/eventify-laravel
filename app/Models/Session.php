<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'event_sessions';

    protected $fillable = [
        'event_id',
        'speaker_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'capacity',
        'room',
    ];
}
