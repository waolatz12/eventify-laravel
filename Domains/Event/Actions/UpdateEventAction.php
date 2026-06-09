<?php
namespace App\Domain\Event\Actions;

use App\Domains\Event\Models\EventModel;

class UpdateEventAction
{
    public function execute(EventModel $event, array $data): EventModel
    {
        $event->update($data);
        return $event;
    }
}
