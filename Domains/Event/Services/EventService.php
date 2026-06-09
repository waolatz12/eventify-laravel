<?php

namespace App\Domain\Event\Services;

use App\Domains\Event\Models\EventModel;
use App\Domain\Event\Actions\CreateEventAction;
use App\Domain\Event\Actions\UpdateEventAction;

class EventService
{
    public function __construct(
        private CreateEventAction $createEvent,
        private UpdateEventAction $updateEvent
    ) {}

    public function create(array $data): EventModel
    {
        return $this->createEvent->execute($data);
    }

    public function update(EventModel $event, array $data): EventModel
    {
        return $this->updateEvent->execute($event, $data);
    }

    public function publish(EventModel $event)
    {
        $event->update(['status' => 'active']);
    }

    public function close(EventModel $event)
    {
        $event->update(['status' => 'closed']);
    }
}
