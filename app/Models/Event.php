<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function users (){
        return $this->belongsToMany(User::class, 'event_users')
            ->withPivot('registered_at') //return the registered_at column from the pivot table
            ->withTimestamps();
    }

}
