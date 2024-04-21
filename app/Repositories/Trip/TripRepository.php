<?php

namespace App\Repositories\Trip;

use App\Dto\TRip\AvailableTripDto;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Model;

class TripRepository implements TripRepositoryInterface
{
    /**
     * get available trip
     *
     * @param AvailableTripDto $availableTripDto
     * @param $withLock
     * @return Model|null
     */
    public function getAvailableTrip(AvailableTripDto $availableTripDto, $withLock = false): Model|null
    {
        return Trip::query()
            ->where('id', $availableTripDto->trip_id)
            ->whereHas('trip_stations', function ($query) use ($availableTripDto) {
                $query->where('station_id', $availableTripDto->trip_station_from_id)->whereDate('departure_time', $availableTripDto->date);
            })
            ->whereHas('trip_stations', function ($query) use ($availableTripDto) {
                $query->where('station_id', $availableTripDto->trip_station_to_id);
            })
            ->when($withLock, function ($query) {
                $query->lockForUpdate();
            })
            ->with('bus', 'trip_stations')
            ->first();
    }
}
