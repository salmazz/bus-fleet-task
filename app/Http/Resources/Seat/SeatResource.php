<?php

namespace App\Http\Resources\Seat;

use App\Http\Resources\Bus\BusResource;
use App\Http\Resources\Station\CityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatResource extends JsonResource
{
    public $trip;

    public function __construct($resource, $trip = null)
    {
        parent::__construct($resource);
        $this->trip = $trip;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bus' => new BusResource($this->whenLoaded('bus')),
            'seat_number' => $this->number,
            'trip' => [
                'start_city_id' => new CityResource($this->trip->startCity),
                'end_city_id' => new CityResource($this->trip->endCity),
                'date' => $this->trip->date->format('Y-m-d'),
            ],
        ];
    }
}
