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
            'title' => $data['title'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'],
            'sale_start' => $data['sale_start'],
            'sale_end' => $data['sale_end'],
        ]);
    }
}
