<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function storeEventTicket(Event $event, array $data): Ticket
    {

        // Assumes Event model has a hasMany relationship: public function tickets()
        return $event->tickets()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
        ]);
    }
}
