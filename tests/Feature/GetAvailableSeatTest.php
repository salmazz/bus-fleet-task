<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAvailableSeatTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh --seed');
    }

    /** @test */
    public function test_that_get_available_seats_retrieved_successfully()
    {
        $trip = Trip::find(1);

        // Make a request to the endpoint
        $response = $this->json('get', '/api/available-seats', [
            'trip_station_from_id' => '1',
            'trip_station_to_id' => '4',
            'date' => '2024-04-25',
            'trip_id' => $trip->id,
        ]);

        // Assert the available seats data
        $response->assertJson([
            'code' => 200,
            'message' => 'Available seats retrieved successfully',
            'data' => [
                'available_seats' => collect(range(1, $trip->bus->capacity))->values()->toArray()
            ]
        ]);
    }

    /** @test */
    public function test_didnt_retrieve_booked_seats()
    {
        $trip = Trip::find(1);

        // Book a seat
        Booking::create([
            'trip_id' => $trip->id,
            'trip_station_from_id' => '1',
            'trip_station_to_id' => '4',
            'seat_number' => 1,
            'user_id' => 1,
        ]);

        // Make a request to the endpoint
        $response = $this->json('get', '/api/available-seats', [
            'trip_station_from_id' => '1',
            'trip_station_to_id' => '4',
            'date' => '2024-04-25',
            'trip_id' => $trip->id,
        ]);

        // Assert the available seats data
        $response->assertJson([
            'code' => 200,
            'message' => 'Available seats retrieved successfully',
            'data' => [
                'available_seats' => collect(range(2, $trip->bus->capacity))->values()->toArray()
            ]
        ]);
    }

    /** @test */
    public function test_giving_404_for_not_found_trip()
    {
        // Make a request to the endpoint
        $response = $this->json('get', '/api/available-seats', [
            'trip_station_from_id' => '1',
            'trip_station_to_id' => '4',
            'date' => '2024-04-25',
            'trip_id' => '2',
        ]);

        // Assert the available seats data
        $response->assertJson([
            'code' => 404,
            'message' => 'Trip not found',
            'data' => [
                'available_seats' => [],
            ]
        ]);
    }
}
