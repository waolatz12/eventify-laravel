<?php

namespace App\Domains\Event\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\Ticket\Models\Ticket;

class EventModel extends Model
{
        protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'price',
        'capacity',
        'tickets_available',
        'status'
    ];

    // Relationships
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Domain Logic (VERY IMPORTANT IN DDD)
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function hasTicketsAvailable(int $qty = 1): bool
    {
        return $this->tickets_available >= $qty;
    }

    public function reduceTickets(int $qty)
    {
        $this->decrement('tickets_available', $qty);
    }
}
