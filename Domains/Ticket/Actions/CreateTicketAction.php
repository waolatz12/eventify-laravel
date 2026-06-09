<?php

namespace App\Domain\Ticket\Actions;

use App\Domains\Ticket\Models\Ticket;

class CreateTicketAction
{
    public function execute(array $data): Ticket
    {
        $data['tickets_available'] = $data['capacity'];

        return Ticket::create($data);
    }
}
