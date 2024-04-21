<?php

namespace App\Http\Resources\Bus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
           'vehicle_number' => $this->vehicle_number,
           'capacity' => $this->capacity
       ];
    }
}
