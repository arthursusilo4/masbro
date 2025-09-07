<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BrandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_branding')->insert([
            ['id' => 1, 'name' => 'Poster'],
            ['id' => 2, 'name' => 'Sticker'],
            ['id' => 3, 'name' => 'Dummy'],
            ['id' => 4, 'name' => 'Layar Toko'],
            ['id' => 5, 'name' => 'Full Branding'],
            ['id' => 6, 'name' => 'A-Board'],
            ['id' => 7, 'name' => 'Flag Chain'],
        ]);
    }
}
