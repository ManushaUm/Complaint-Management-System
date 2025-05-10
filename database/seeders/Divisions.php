<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Divisions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            [
                'id' => 1,
                'division_name' => 'Customer Onboarding',  // For Customer Service (Dep 1-a)
                'division_code' => '00010a',
                'department_code' => '00010',  // Customer Service
                'division_head' => 'EMP012',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'division_name' => 'Claims Processing',  // For Claims (Dep 2-a)
                'division_code' => '00011a',
                'department_code' => '00011',  // Claims
                'division_head' => 'EMP013',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'division_name' => 'Legal Counsel',  // For Compliance & Legal (Dep 3-a)
                'division_code' => '00012a',
                'department_code' => '00012',  // Compliance & Legal
                'division_head' => 'EMP009',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'division_name' => 'Customer Support',  // For Customer Service (Dep 1-b)
                'division_code' => '00010b',
                'department_code' => '00010',  // Customer Service
                'division_head' => 'EMP014',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 15,
                'division_name' => 'Appeals & Escalations',  // For Grievance Redressal (Div 5-a)
                'division_code' => '00014a',
                'department_code' => '00014',  // Grievance Redressal
                'division_head' => 'EMP020',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 16,
                'division_name' => 'Quality Audit',  // For Quality Assurance & Investigation (Dep 4-a)
                'division_code' => '00013a',
                'department_code' => '00013',  // Quality Assurance & Investigation
                'division_head' => 'EMP021',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 17,
                'division_name' => 'Investigations',  // For Quality Assurance & Investigation (Dep 4-b)
                'division_code' => '00013b',
                'department_code' => '00013',  // Quality Assurance & Investigation
                'division_head' => 'EMP013',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 18,
                'division_name' => 'Service Delivery',  // For Customer Service (Dep 1-d)
                'division_code' => '00010d',
                'department_code' => '00010',  // Customer Service
                'division_head' => 'EMP017',
                'status' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
        ];

        DB::table('divisions_table')->insert($divisions);
    }
}
