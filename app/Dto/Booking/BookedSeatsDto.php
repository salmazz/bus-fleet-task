<?php

namespace App\Dto\Booking;

class BookedSeatsDto {
    public $trip_id;
    public $start_station_order;
    public $end_station_order;

    public function __construct($trip_id, $start_station_order, $end_station_order) {
        $this->trip_id = $trip_id;
        $this->start_station_order = $start_station_order;
        $this->end_station_order = $end_station_order;
    }
}
