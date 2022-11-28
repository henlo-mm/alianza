<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Administrador/a'],
            ['id' => 2, 'name' => 'Jefe'],
            ['id' => 3, 'name' => 'Colaborador'],
        ]);
    }
}
