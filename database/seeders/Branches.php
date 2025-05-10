<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Branches extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'branch_name' => 'Colombo',
                'branch_code' => 'CMB1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Kandy',
                'branch_code' => 'KDY',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => 'Rathnapura',
                'branch_code' => 'Rat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
