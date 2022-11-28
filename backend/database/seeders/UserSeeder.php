<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'test@test.com', 
                'password' => '12345678', 
                'employee_id' => 1,
                'remember_token' => Str::random(10)
            ],
        ]);
    }
}
