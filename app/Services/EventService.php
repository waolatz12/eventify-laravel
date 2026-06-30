<?php

namespace App\Services;

use App\Enums\EventFormat;
use App\Models\User;
use App\Enums\EventStatus;
use Illuminate\Support\Str;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;


class EventService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function registerUser(User $user, array $eventIds)
    {
        //sync new event ids to users without removing existing user entries
        // $user->events()->syncWithoutDetaching($eventIds);
        $user->events()->syncWithoutDetaching($eventIds);
        // $user->events()->attach($eventIds);//if you prefer to attach without checking for duplicates, but it may throw an error if the same event is attached multiple times
        return $user->load('events');
    }

    public function createEvent(array $data)
    {
        $data['organizer_id'] = Auth::user()->id;
        return Event::create($data);
    }

    // public function updateEvent (Event $event, array $data){
    //     return Event::update($event->id, $data);
    // }

    public function updateEvent(Event $event, array $data): Event
    {

        if (isset($data['title'])) {

            $data['slug'] = Str::slug($data['title']);
        }

        $event->update(
            $data
        );

        return $event->fresh();
    }
}
