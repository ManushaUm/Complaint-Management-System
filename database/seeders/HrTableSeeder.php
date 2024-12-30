<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample data
        DB::table('hr')->insert([
            // Department Heads and Sub Heads
            [
                'emp_id' => 'EMP001',
                'full_name' => 'Mr. Saman',
                'email' => 'saman@example.com',
                'gender' => 'male',
                'phone' => '0711235232',
                'job_title' => 'Department Head',
                'department' => '00010',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP002',
                'full_name' => 'Mr. Gayan',
                'email' => 'gayan@example.com',
                'gender' => 'male',
                'phone' => '0713456789',
                'job_title' => 'Department Sub Head',
                'department' => '00010',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP003',
                'full_name' => 'Mr. Suneth',
                'email' => 'suneth@example.com',
                'gender' => 'male',
                'phone' => '0719876543',
                'job_title' => 'Department Head',
                'department' => '00011',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP004',
                'full_name' => 'Mrs. Gayathri',
                'email' => 'gayathri@example.com',
                'gender' => 'female',
                'phone' => '0711122334',
                'job_title' => 'Department Sub Head',
                'department' => '00011',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP005',
                'full_name' => 'Mr. Jagath',
                'email' => 'jagath@example.com',
                'gender' => 'male',
                'phone' => '0712233445',
                'job_title' => 'Department Head',
                'department' => '00012',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP006',
                'full_name' => 'Mr. Sunil',
                'email' => 'sunil@example.com',
                'gender' => 'male',
                'phone' => '0713344556',
                'job_title' => 'Department Sub Head',
                'department' => '00012',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP007',
                'full_name' => 'Mr. Ajith',
                'email' => 'ajith@example.com',
                'gender' => 'male',
                'phone' => '0714455667',
                'job_title' => 'Department Head',
                'department' => '00013',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP008',
                'full_name' => 'Mr. Farooz',
                'email' => 'farooz@example.com',
                'gender' => 'male',
                'phone' => '0715566778',
                'job_title' => 'Department Sub Head',
                'department' => '00013',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP009',
                'full_name' => 'Mr. Suraj',
                'email' => 'suraj@example.com',
                'gender' => 'male',
                'phone' => '0716677889',
                'job_title' => 'Department Head',
                'department' => '00014',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP010',
                'full_name' => 'Mr. Hamaz',
                'email' => 'hamaz@example.com',
                'gender' => 'male',
                'phone' => '0717788990',
                'job_title' => 'Department Sub Head',
                'department' => '00014',
                'division' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Division Heads
            [
                'emp_id' => 'EMP011',
                'full_name' => 'Mr. Wanniarachchi',
                'email' => 'wanniarachchi@example.com',
                'gender' => 'male',
                'phone' => '0718899001',
                'job_title' => 'Division Head',
                'department' => '00010',
                'division' => '00010a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP012',
                'full_name' => 'Mr. Nimath',
                'email' => 'nimath@example.com',
                'gender' => 'male',
                'phone' => '0718899002',
                'job_title' => 'Division Head',
                'department' => '00011',
                'division' => '00011a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP013',
                'full_name' => 'Mr. Sahan',
                'email' => 'sahan@example.com',
                'gender' => 'male',
                'phone' => '0718899003',
                'job_title' => 'Division Head',
                'department' => '00012',
                'division' => '00012a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP014',
                'full_name' => 'Mrs. Shehani',
                'email' => 'shehani@example.com',
                'gender' => 'female',
                'phone' => '0718899004',
                'job_title' => 'Division Head',
                'department' => '00012',
                'division' => '00012b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP015',
                'full_name' => 'Mr. Shihaz',
                'email' => 'shihaz@example.com',
                'gender' => 'male',
                'phone' => '0718899005',
                'job_title' => 'Division Head',
                'department' => '00013',
                'division' => '00013a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP016',
                'full_name' => 'Mrs. Nayomi',
                'email' => 'nayomi@example.com',
                'gender' => 'female',
                'phone' => '0718899006',
                'job_title' => 'Division Head',
                'department' => '00014',
                'division' => '00014a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Assistant Division Heads
            [
                'emp_id' => 'EMP017',
                'full_name' => 'Mr. Kasun',
                'email' => 'kasun@example.com',
                'gender' => 'male',
                'phone' => '0719123456',
                'job_title' => 'Assistant Division Head',
                'department' => '00010',
                'division' => '00010a',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP018',
                'full_name' => 'Mrs. Nirosha',
                'email' => 'nirosha@example.com',
                'gender' => 'female',
                'phone' => '0719345678',
                'job_title' => 'Assistant Division Head',
                'department' => '00011',
                'division' => '00011b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP019',
                'full_name' => 'Mr. Anuradha',
                'email' => 'anuradha@example.com',
                'gender' => 'male',
                'phone' => '0719567890',
                'job_title' => 'Assistant Division Head',
                'department' => '00012',
                'division' => '00012c',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP020',
                'full_name' => 'Mrs. Udani',
                'email' => 'udani@example.com',
                'gender' => 'female',
                'phone' => '0719789012',
                'job_title' => 'Assistant Division Head',
                'department' => '00013',
                'division' => '00013b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emp_id' => 'EMP021',
                'full_name' => 'Mr. Roshan',
                'email' => 'roshan@example.com',
                'gender' => 'male',
                'phone' => '0719901234',
                'job_title' => 'Assistant Division Head',
                'department' => '00014',
                'division' => '00014b',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
