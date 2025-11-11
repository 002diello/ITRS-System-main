<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department' => 'IT',
        ]);

        // Create HOD IT
        User::create([
            'name' => 'HOD IT',
            'email' => 'hod.it@example.com',
            'password' => Hash::make('password'),
            'role' => 'hod_it',
            'department' => 'IT',
        ]);

        // Create HOD Finance
        User::create([
            'name' => 'HOD Finance',
            'email' => 'hod.finance@example.com',
            'password' => Hash::make('password'),
            'role' => 'hod',
            'department' => 'Finance',
        ]);

        // Create HOD Marketing
        User::create([
            'name' => 'HOD Marketing',
            'email' => 'hod.marketing@example.com',
            'password' => Hash::make('password'),
            'role' => 'hod',
            'department' => 'Marketing',
        ]);

        // Create IT Staff - Soben
        User::create([
            'name' => 'Soben',
            'email' => 'soben@example.com',
            'password' => Hash::make('password'),
            'role' => 'it_staff',
            'department' => 'IT',
        ]);

        // Create IT Staff - Wani
        User::create([
            'name' => 'Wani',
            'email' => 'wani@example.com',
            'password' => Hash::make('password'),
            'role' => 'it_staff',
            'department' => 'IT',
        ]);

        // Create IT Staff - Farid
        User::create([
            'name' => 'Farid',
            'email' => 'farid@example.com',
            'password' => Hash::make('password'),
            'role' => 'it_staff',
            'department' => 'IT',
        ]);

        // Create Regular Users
        User::create([
            'name' => 'Finance User',
            'email' => 'user.finance@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'department' => 'Finance',
        ]);

        User::create([
            'name' => 'Marketing User',
            'email' => 'user.marketing@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'department' => 'Marketing',
        ]);
    }
}
