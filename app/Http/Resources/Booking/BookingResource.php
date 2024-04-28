<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Trip\TripResource;
use App\Http\Resources\User\UserResource;
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
        $this->loadMissing(['trip', 'trip.stations']);
        $trip = $this->trip;
        $tripStations = $trip->stations;
        $fromStationName = null;
        $toStationName = null;
        foreach ($tripStations as $station) {
            if ($station->id === $this->trip_station_from_id) {
                $fromStationName = $station->name;
            }
            if ($station->id === $this->trip_station_to_id) {
                $toStationName = $station->name;
                break;
            }
        }

        return [
            'trip_id' => $trip->id,
            'user_id' => new UserResource($this->user),
            'from_station_name' => $fromStationName,
            'to_station_name' => $toStationName,
            'seat_number' => $this->seat_number
        ];
    }
}
