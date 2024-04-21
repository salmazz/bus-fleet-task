<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookSeatTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh --seed');
    }

    /** @test */
    public function test_that_user_can_book_available_seat()
    {
        $trip = Trip::find(1);

        // Make a request to the endpoint
        $response = $this->json('post', '/api/book-seat', [
            'trip_station_from_id' => '1',
            'trip_station_to_id' => '4',
            'date' => '2024-04-25',
            'trip_id' => $trip->id,
            'user_id' => '2',
            'seat_number' => '1',
        ]);

        $response->assertJson([
            'code' => 200,
            'message' => 'Booked successfully',
        ]);

        // Assert the available seats data
        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                'booking' => [
                    'user_id',
                    'trip_id',
                    'trip_station_from_id',
                    'trip_station_to_id',
                    'seat_number',
                    'updated_at',
                    'created_at',
                    'id',
                ]
            ]
        ]);
    }
}
