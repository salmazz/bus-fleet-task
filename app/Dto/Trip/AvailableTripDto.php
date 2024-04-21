<?php

namespace App\Dto\TRip;

class AvailableTripDto {
    public $trip_id;
    public $trip_station_from_id;
    public $trip_station_to_id;
    public $date;

    public function __construct($trip_id, $trip_station_from_id, $trip_station_to_id, $date) {
        $this->trip_id = $trip_id;
        $this->trip_station_from_id = $trip_station_from_id;
        $this->trip_station_to_id = $trip_station_to_id;
        $this->date = $date;
    }
}
