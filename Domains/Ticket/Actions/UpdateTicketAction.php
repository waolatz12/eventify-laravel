<?php

namespace App\Domain\Ticket\Actions;
use App\Domains\Ticket\Models\Ticket;

class UpdateTicketAction
{
    public function execute(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }
}
