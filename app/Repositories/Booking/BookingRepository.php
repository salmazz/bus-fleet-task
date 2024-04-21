<?php

namespace App\Repositories\Booking;

use App\Dto\Booking\BookedSeatsDto;
use App\Dto\Booking\BookSeatDto;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * get booked seats
     *
     * @param BookedSeatsDto $bookedSeatsDto
     * @return Collection
     */
    public function getBookedSeats(BookedSeatsDto $bookedSeatsDto): Collection
    {
        return Booking::query()
            ->where('trip_id', $bookedSeatsDto->trip_id)
            ->whereHas('trip_station_from', function ($query) use ($bookedSeatsDto) {
                $query->whereBetween('order', [$bookedSeatsDto->start_station_order, $bookedSeatsDto->end_station_order]);
            })
            ->whereHas('trip_station_to', function ($query) use ($bookedSeatsDto) {
                $query->whereBetween('order', [$bookedSeatsDto->start_station_order, $bookedSeatsDto->end_station_order]);
            })
            ->get();
    }

    /**
     * book a seat
     *
     * @param BookSeatDto $bookedSeatsDto
     * @return Model
     */
    public function bookSeat(BookSeatDto $bookedSeatsDto): Model
    {
        return Booking::create([
            'user_id' => $bookedSeatsDto->user_id,
            'trip_id' => $bookedSeatsDto->trip_id,
            'trip_station_from_id' => $bookedSeatsDto->trip_station_from_id,
            'trip_station_to_id' => $bookedSeatsDto->trip_station_to_id,
            'seat_number' => $bookedSeatsDto->seat_number,
            'date' => $bookedSeatsDto->date,
        ]);
    }
}
