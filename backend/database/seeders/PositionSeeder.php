<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['id' => 1, 'name' => 'Director'],
            ['id' => 2, 'name' => 'Diseñador Gráfico'],
            ['id' => 3, 'name' => 'Realizador Audiovisual'],
            ['id' => 4, 'name' => 'Community Manager'],
        ]);
    }
}
