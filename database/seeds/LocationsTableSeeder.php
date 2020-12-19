<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'shed'     => 1,
            'room'     => 1,
            'capacity' => 1,
            'phase_id' => 1,
        ]);

        Location::create([
            'shed'     => 1,
            'room'     => 2,
            'capacity' => 1,
            'phase_id' => 1,
        ]);

        Location::create([
            'shed'     => 1,
            'room'     => 3,
            'capacity' => 1,
            'phase_id' => 1,
        ]);

        Location::create([
            'shed'     => 2,
            'room'     => 1,
            'capacity' => 30,
            'phase_id' => 4,
        ]);

        Location::create([
            'shed'     => 2,
            'room'     => 2,
            'capacity' => 30,
            'phase_id' => 4,
        ]);

        Location::create([
            'shed'     => 2,
            'room'     => 3,
            'capacity' => 30,
            'phase_id' => 4,
        ]);
    }
}
