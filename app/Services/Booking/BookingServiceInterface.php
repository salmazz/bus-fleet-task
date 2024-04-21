<?php

namespace App\Services\Booking;

use App\Dto\Booking\AvailableSeatDto;
use App\Dto\Booking\BookSeatDto;
use Illuminate\Database\Eloquent\Model;

interface BookingServiceInterface
{
    /**
     * get available seats for a trip
     *
     * @param AvailableSeatDto $availableSeatDto
     * @return array
     * @throws \Exception
     */
    public function getAvailableSeats(AvailableSeatDto $availableSeatDto) :array;

    /**
     * Book a seat for a trip
     *
     * @param BookSeatDto $bookSeatDto
     * @return Model
     * @throws \Exception
     */
    public function bookSeat(BookSeatDto $bookSeatDto) :Model;
}
