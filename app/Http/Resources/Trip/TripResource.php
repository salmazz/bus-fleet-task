<?php

namespace App\Http\Resources\Trip;

use App\Http\Resources\Bus\BusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "bus_id" => new BusResource($this->bus),
        ];
    }
}
