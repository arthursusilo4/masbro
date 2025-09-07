<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'nik' => 'regionaljatim',
                'role_id' => 1,
                'branch_id' => 6,
                'cluster_id' => 14,
                'name' => 'Regional Jatim',
                'email' => 'regionaljatim@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('54321'),
                'remember_token' => Str::random(10),
        ],);

        User::create([
                'nik' => 'clssub',
                'role_id' => 1,
                'branch_id' => 6,
                'cluster_id' => 14,
                'name' => 'Cluster Surabaya',
                'email' => 'clssub@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345'),
                'remember_token' => Str::random(10),
        ],);
    }
}
