<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Models\Ticket;
use App\Models\Event;
use App\Http\Requests\Ticket\StoreTicketRequest;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $eventService
    ) {
        // $this->eventService = $eventService;
    }

    public function store(StoreTicketRequest $request, Event $event)
    {
        try {

            // dd($event);
            // In TicketController.php
            $this->authorize('create', [Ticket::class, $event]);

            $ticket = $this->eventService->storeEventTicket($event, $request->validated());

            return response()->json([
                'status' => 'sucess',
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
