<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Trip\TripResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trip_id' => new TripResource($this->trip),
            'user_id' => $this->user_id,
            'trip_station_from_id' => $this->trip_station_from_id,
            'trip_station_to_id' => $this->trip_station_to_id,
            'seat_number' => $this->seat_number,
        ];
    }
}
