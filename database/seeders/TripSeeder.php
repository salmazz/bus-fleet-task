<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use App\Models\TripStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bus = Bus::first();

        $trip1 = Trip::create([
            'bus_id' => $bus->id,
        ]);

        TripStation::create(['trip_id' => $trip1->id, 'station_id' => 1, 'departure_time' => '2024-04-25 08:00:00', 'order' => 1]);
        TripStation::create(['trip_id' => $trip1->id, 'station_id' => 2, 'departure_time' => '2024-04-25 09:00:00', 'order' => 2]);
        TripStation::create(['trip_id' => $trip1->id, 'station_id' => 3, 'departure_time' => '2024-04-25 10:00:00', 'order' => 3]);
        TripStation::create(['trip_id' => $trip1->id, 'station_id' => 4, 'departure_time' => null, 'order' => 4]);
    }
}
