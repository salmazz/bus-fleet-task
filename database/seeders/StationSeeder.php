<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\City;
use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            'Cairo',
            'AlFayyum',
            'Minya',
            'Asyut',
        ];

        foreach($stations as $station) {
            Station::factory() ->create(['name' => $station]);
        }
    }
}
