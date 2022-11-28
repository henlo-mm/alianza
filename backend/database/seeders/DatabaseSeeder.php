<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $states_path = resource_path('database/states.sql');
        
        \DB::unprepared(
            file_get_contents($states_path)
        );

        $cities_path = resource_path('database/cities.sql');


        \DB::unprepared(
            file_get_contents($cities_path)
        );

        $this->call([
            RolSeeder::class,
            PositionSeeder::class,
        ]);
    }
}
