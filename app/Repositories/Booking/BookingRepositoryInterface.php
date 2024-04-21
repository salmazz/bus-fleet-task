<?php

namespace App\Repositories\Booking;

use App\Dto\Booking\BookedSeatsDto;
use App\Dto\Booking\BookSeatDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BookingRepositoryInterface
{
    /**
     * get booked seats
     *
     * @param BookedSeatsDto $bookedSeatsDto
     * @return Collection
     */
    public function getBookedSeats(BookedSeatsDto $bookedSeatsDto): Collection;

    /**
     * book a seat
     *
     * @param BookSeatDto $bookedSeatsDto
     * @return Model
     */
    public function bookSeat(BookSeatDto $bookedSeatsDto): Model;
}
