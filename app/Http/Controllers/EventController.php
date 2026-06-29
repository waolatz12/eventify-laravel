<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\EventService;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\User;
use App\Policies\EventPolicy;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{

    public function __construct(
        protected EventService $eventService
    )
    {
        // $this->eventService = $eventService;
    }

    public function register (Request $request, User $user){
        try{
            // $user = $request->user();

            if (empty($request->event_ids) || !is_array($request->event_ids)){
                return response()->json([
                    'status' => 'error',
                    'message' => "Invalid event_ids. It should be a non-empty array of event IDs.",
                ], 400);
            }
            return response()->json([
                'status' => 'success',
                'message' => "User Registered for Event Successfully",
                'data' => $this->eventService->registerUser($user, $request->event_ids),
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message'=> $e->getMessage()
            ], 500);
        }

    }

    public function create (StoreEventRequest $request){
        try {
            $data = $request->all();
            $event = $this->eventService->createEvent($data);
            return response()->json([
                'status' => 'success',
                'message' => "Event Created Successfully",
                'data' => $event,
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function update (UpdateEventRequest $request, Event $event){
        try {

        // $data = $request->all();
          $this->authorize(
            'update',
            $event
        );
        $event = $this->eventService->updateEvent($event, $request->validated());

        } catch (\Exception $e){
            return response()->json([
                'status'=> 'error',
                'message'=> $e->getMessage()
            ],500);
        }

    }

    public function delete (DeleteEventRequest $request, Event $event){
        
    }

}
