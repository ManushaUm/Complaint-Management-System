<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $departments = [
            [
                'id' => 1,
                'department_name' => 'Customer Service',
                'department_code' => '00010',
                'department_head' => 'EMP007',
                'department_alter_head' => 'EMP001',
                'department_divisions' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'department_name' => 'Claims',
                'department_code' => '00011',
                'department_head' => 'EMP012',
                'department_alter_head' => 'EMP004',
                'department_divisions' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'department_name' => 'Compliance & Legal',
                'department_code' => '00012',
                'department_head' => 'EMP005',
                'department_alter_head' => 'EMP006',
                'department_divisions' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6, // Keeping original id
                'department_name' => 'Quality Assurance & Investigation',
                'department_code' => '00013',
                'department_head' => 'EMP006',
                'department_alter_head' => 'EMP007',
                'department_divisions' => null,
                'created_at' => '2025-01-04 18:00:00',
                'updated_at' => '2025-01-04 18:00:00',
            ],
            [
                'id' => 8, // Keeping original id
                'department_name' => 'Grievance Redressal',
                'department_code' => '00014',
                'department_head' => 'EMP006',
                'department_alter_head' => 'EMP007',
                'department_divisions' => null,
                'created_at' => '2025-01-05 20:40:00',
                'updated_at' => '2025-01-05 20:40:00',
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
