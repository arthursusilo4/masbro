<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            ['id' => 1, 'name' => 'SBP'],
            ['id' => 2, 'name' => 'Internal'],
            ['id' => 3, 'name' => 'Regional'],
        ]);

        DB::table('jabatan')->insert([
            ['id' => 1, 'role_id' => 1, 'name' => 'GM'],
            ['id' => 2, 'role_id' => 1, 'name' => 'Manager'],
            ['id' => 3, 'role_id' => 1, 'name' => 'SPV SF'],
            ['id' => 4, 'role_id' => 1, 'name' => 'SPV DS'],
        ]);
    }
}
