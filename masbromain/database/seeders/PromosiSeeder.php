<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PromosiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_promosi')->insert([
            // Outlet
            ['id' => 1, 'name' => 'Ava'],
            ['id' => 2, 'name' => 'New Product'],
            ['id' => 3, 'name' => 'Material Promo'],
            ['id' => 4, 'name' => 'Program'],
            ['id' => 5, 'name' => 'Outlet Branding'],
            // Non Outlet
            ['id' => 6, 'name' => 'Out Of Home'],
            ['id' => 7, 'name' => 'Car Free Day'],
            ['id' => 8, 'name' => 'Bagi Bagi Kartu'],
            // Lainnya
            ['id' => 9, 'name' => 'Lainnya'],
        ]);
    }
}
