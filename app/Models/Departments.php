<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Departments extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_head',
        'department_alter_head',

    ];

    public function getDepartment()
    {
        $departmentData = DB::table('departments')
            ->select('*')
            ->where('is active', 1)
            ->orderBy('department_name', 'ASC')
            ->get();
        return $departmentData;
    }

    public function getDivision()
    {
        $divisionData = DB::table('divisions_table')
            ->select('*')
            ->where('status', 1)
            ->orderBy('division_name', 'ASC')
            ->get();
        return $divisionData;
    }
}
