<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complaint_types')->insert([
            [
                'complaint_type' => 'Marketing and Sales',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Motor Underwritings',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Non-motor Underwriting',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Motor claims',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Non-motor claims',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Policy Serving',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complaint_type' => 'Premium',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
