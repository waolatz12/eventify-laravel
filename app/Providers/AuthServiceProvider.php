<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Ticket;
use App\Policies\EventPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Create a new class instance.
     */


    protected $policies = [
        Event::class => EventPolicy::class,
        Ticket::class => TicketPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
