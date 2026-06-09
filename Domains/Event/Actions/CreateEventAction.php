<?php

namespace App\Domain\Event\Actions;

use App\Domains\Event\Models\EventModel;

class CreateEventAction
{
    public function execute(array $data): EventModel
    {
        $data['tickets_available'] = $data['capacity'];

        return EventModel::create($data);
    }
}
