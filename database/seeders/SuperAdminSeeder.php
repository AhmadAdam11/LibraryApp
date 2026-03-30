<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'status'=> 'active',
        ]);
    }
}