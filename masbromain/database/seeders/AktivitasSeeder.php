<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_aktivitas')->insert([
            ['id' => 1, 'name' => 'Temu Outlet'],
            ['id' => 2, 'name' => 'Visit MDN atau MDR'],
            ['id' => 3, 'name' => 'Visit Instansi'],
            ['id' => 4, 'name' => 'Visit Komunitas'],
            ['id' => 5, 'name' => 'Visit Sekolah'],
        ]);
    }
}
