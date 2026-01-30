<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@desatanalum.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Admin Desa
        User::create([
            'name' => 'Admin Desa Tanalum',
            'email' => 'admin@desatanalum.id',
            'password' => Hash::make('password'),
            'role' => 'admin_desa',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Operator
        User::create([
            'name' => 'Operator Desa',
            'email' => 'operator@desatanalum.id',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
