<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator with full access',
            ],
            [
                'name' => 'HOD',
                'slug' => 'hod',
                'description' => 'Head of Department',
            ],
            [
                'name' => 'HOD IT',
                'slug' => 'hod-it',
                'description' => 'Head of IT Department',
            ],
            [
                'name' => 'IT Staff',
                'slug' => 'it-staff',
                'description' => 'IT Staff Member',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Regular User',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
