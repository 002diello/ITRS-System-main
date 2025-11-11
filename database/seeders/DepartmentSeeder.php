<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'IT Department',
            ],
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Human Resources Department',
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Finance Department',
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Marketing Department',
            ],
            [
                'name' => 'Operations',
                'code' => 'OPS',
                'description' => 'Operations Department',
            ],
            [
                'name' => 'Sales',
                'code' => 'SALES',
                'description' => 'Sales Department',
            ],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['code' => $department['code']],
                $department
            );
        }
    }
}
