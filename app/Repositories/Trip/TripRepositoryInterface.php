<?php

namespace App\Repositories\Trip;

use App\Dto\TRip\AvailableTripDto;
use Illuminate\Database\Eloquent\Model;

interface TripRepositoryInterface
{
    /**
     * get available trip
     *
     * @param AvailableTripDto $availableTripDto
     * @param $withLock
     * @return Model|null
     */
    public function getAvailableTrip(AvailableTripDto $availableTripDto, $withLock = false): Model|null;
}
