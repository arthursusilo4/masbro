<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kompetitor')->insert([
            ['id' => 1, 'name' => 'Telkomsel'],
            ['id' => 2, 'name' => 'Indosat'],
            ['id' => 3, 'name' => 'Three'],
            ['id' => 4, 'name' => 'XL'],
            ['id' => 5, 'name' => 'Smartfren'],
        ]);
    }
}
