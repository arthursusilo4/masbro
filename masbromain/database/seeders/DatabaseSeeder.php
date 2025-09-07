<?php

namespace Database\Seeders;

use App\Models\Kompetitor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(WilayahSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KompetitorSeeder::class);
        $this->call(BrandingSeeder::class);
        $this->call(PromosiSeeder::class);
        $this->call(AktivitasSeeder::class);
    }
}
