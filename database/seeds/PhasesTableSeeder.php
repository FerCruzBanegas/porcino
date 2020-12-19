<?php

use App\Phase;
use Illuminate\Database\Seeder;

class PhasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phase::create([
            'name'        => 'gestación',
            'alias'       => 'GES',
            'description' => 'fase gestante de una reproductora',
        ]);

        Phase::create([
            'name'        => 'maternidad',
            'alias'       => 'MAT',
            'description' => 'fase lactante de una reproductora',
        ]);

        Phase::create([
            'name'        => 'pre-inicio',
            'alias'       => 'PRI',
            'description' => 'fase pre iniciante de un lechón',
        ]);

        Phase::create([
            'name'        => 'inicio',
            'alias'       => 'INI',
            'description' => 'fase iniciante de un lechón',
        ]);
    }
}
