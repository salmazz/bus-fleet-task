<?php

namespace App\Dto\Booking;

class AvailableSeatDto {
    public $trip_station_from_id;
    public $trip_station_to_id;
    public $date;
    public $trip_id;

    public function __construct($trip_station_from_id, $trip_station_to_id, $date, $trip_id) {
        $this->trip_station_from_id = $trip_station_from_id;
        $this->trip_station_to_id = $trip_station_to_id;
        $this->date = $date;
        $this->trip_id = $trip_id;
    }

    public static function fromRequest($requestData) {
        $trip_station_from_id = $requestData['trip_station_from_id'] ?? null;
        $trip_station_to_id = $requestData['trip_station_to_id'] ?? null;
        $date = $requestData['date'] ?? null;
        $trip_id = $requestData['trip_id'] ?? null;

        return new self($trip_station_from_id, $trip_station_to_id, $date, $trip_id);
    }
}
