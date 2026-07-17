<?php

namespace Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class CreateEventTest extends TestCase
{
    use RefreshDatabase; //
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_organizer_can_create_event()
    {
        //create a fictitious user
        Sanctum::actingAs(
            User::factory()->create([
                'role' => 'organizer'
            ])
        );

        //call the endpoint
        $response = $this->postJson(
            '/api/events',
            [
                'title' => 'Laravel Conference',
                'slug' => 'laravel-conference',
                'description' => 'This is a conference of the elites',
                'venue' => 'Ibadan, Oluyole',
                'goal' => 'Teach Laravel',
                'date' => '2026-07-09',
                'format'=> 'physical',
                'status' => 'published',
                'capacity' => 500
            ]
        );

        // $response->dd();

        //do the insertion
        $response->assertCreated();

        //check whether the insertion is done
        $this->assertDatabaseHas(
            'events',
            [
                'title' => 'Laravel Conference'
            ]
        );

        //run php artisan test to implement the test
    }


    public function test_attendees_cannot_create_event(){
        Sanctum::actingAs(
            User::factory()->create()
        );

               //call the endpoint
        $response = $this->postJson(
            '/api/events',
            [
                'title' => 'Laravel Conference',
                'slug' => 'laravel-conference',
                'description' => 'This is a conference of the elites',
                'venue' => 'Ibadan, Oluyole',
                'goal' => 'Teach Laravel',
                'date' => '2026-07-09',
                'format'=> 'physical',
                'status' => 'published',
                'capacity' => 500
            ]
        );

        $response->assertForbidden();

        $response->assertJson([
            'message' => 'only organizers and admins can create events'
        ]);
    }

    public function test_only_creators_can_edit_event(){
        
    }
}
