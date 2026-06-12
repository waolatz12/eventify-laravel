<?php

namespace App\Models;
use App\Enums\EventFormat;
use App\Enums\EventStatus;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function users (){
        return $this->belongsToMany(User::class, 'event_users')
            ->withPivot('registered_at') //return the registered_at column from the pivot table
            ->withTimestamps();
    }


    //convert status and format columns in the DB into PHP objects upon specified in the enum
    protected function casts(): array
    {
        return [
            'status' => EventStatus::class,
            'format' => EventFormat::class,
        ];
    }

}
