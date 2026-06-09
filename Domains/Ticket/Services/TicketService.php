<?php

namespace App\Domain\Event\Services;

use App\Domains\Ticket\Models\Ticket;
use App\Domain\Ticket\Actions\CreateTicketAction;
use App\Domain\Ticket\Actions\UpdateTicketAction;

class EventService
{
    public function __construct(
        private CreateTicketAction $createEvent,
        private UpdateTicketAction $updateEvent
    ) {}

    public function create(array $data): Ticket
    {
        return $this->createEvent->execute($data);
    }

    public function update(Ticket $event, array $data): Ticket
    {
        return $this->updateEvent->execute($event, $data);
    }

    public function publish(Ticket $event)
    {
        $event->update(['status' => 'active']);
    }

    public function close(Ticket $event)
    {
        $event->update(['status' => 'closed']);
    }
}
