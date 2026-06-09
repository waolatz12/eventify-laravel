<?php

namespace App\Http\Controllers;
use App\Services\EventService;
use App\Models\User;

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

    public function create (Request $request){
        try {

            if (empty($request->title) || empty($request->date)){
                return response()->json([
                    'status' => 'error',
                    'message' => "Title and Date are required fields.",
                ], 400);
            }
            $data = $request->all();
            return response()->json([
                'status' => 'success',
                'message' => "Event Created Successfully",
                'data' => $this->eventService->createEvent($data),
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

}
