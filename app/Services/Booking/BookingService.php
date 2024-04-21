<?php

namespace App\Services\Booking;

use App\Dto\Booking\AvailableSeatDto;
use App\Dto\Booking\BookedSeatsDto;
use App\Dto\Booking\BookSeatDto;
use App\Dto\TRip\AvailableTripDto;
use App\Repositories\Booking\BookingRepositoryInterface;
use App\Repositories\Trip\TripRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingServiceInterface
{
    public function __construct(BookingRepositoryInterface $bookingRepository, TripRepositoryInterface $tripRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->tripRepository = $tripRepository;
    }

    /**
     * get available seats for a trip
     *
     * @param AvailableSeatDto $availableSeatDto
     * @return array
     * @throws \Exception
     */
    public function getAvailableSeats(AvailableSeatDto $availableSeatDto, $withLock = false) :array
    {
        $availableTripDto = new AvailableTripDto($availableSeatDto->trip_id,$availableSeatDto->trip_station_from_id, $availableSeatDto->trip_station_to_id, $availableSeatDto->date);
        $trip = $this->tripRepository->getAvailableTrip($availableTripDto, $withLock);

        if (! $trip) {
            throw new \Exception('Trip not found');
        }

        $tripStationFromOrder = $trip->trip_stations->where('station_id', $availableSeatDto->trip_station_from_id)->first()->order;
        $tripStationToOrder = $trip->trip_stations->where('station_id', $availableSeatDto->trip_station_to_id)->first()->order;

        $bookedSeatsDto = new BookedSeatsDto($trip->id, $tripStationFromOrder, $tripStationToOrder);
        $bookedSeats = $this->bookingRepository->getBookedSeats($bookedSeatsDto)->pluck('seat_number')->toArray();

        return collect(array_diff(range(1, $trip->bus->capacity), $bookedSeats))->values()->toArray();
    }

    /**
     * Book a seat for a trip
     *
     * @param BookSeatDto $bookSeatDto
     * @return Model
     * @throws \Exception
     */
    public function bookSeat(BookSeatDto $bookSeatDto) :Model
    {
        $availableSeatsDto = new AvailableSeatDto($bookSeatDto->trip_station_from_id, $bookSeatDto->trip_station_to_id, $bookSeatDto->date, $bookSeatDto->trip_id);

        return DB::transaction(function () use ($bookSeatDto, $availableSeatsDto) {
            $availableSeats = $this->getAvailableSeats($availableSeatsDto, true);

            if (! in_array($bookSeatDto->seat_number, $availableSeats)) {
                throw new \Exception('Seat is already booked');
            }

            return $this->bookingRepository->bookSeat($bookSeatDto);
        });
    }
}
