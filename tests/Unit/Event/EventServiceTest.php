<?php

namespace Tests\Unit\Event;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Services\EventService;

class EventServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_if_slug_is_correct(): void
    {
        $service = app(EventService::class);

        $event = $service->createEvent([
            'title' => 'Laravel Conference'
        ]);

        $this->assertEquals(
            'laravel-conference',
            $event->slug
        );
    }
}
