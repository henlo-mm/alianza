<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'name' => 'Test', 
                'last_name' => 'Test Test', 
                'document' => '12121212',
                'address' => 'Cll 23 #3N - 06',
                'phone' => '314 3434 434',
                'rol_id' => 1,
                'states_id' => 1,
                'city_id' => 1
            ],
        ]);
    }
}
