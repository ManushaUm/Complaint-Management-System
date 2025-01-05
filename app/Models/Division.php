<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions_table';

    protected $fillable = [
        'division_name',
        'division_code',
        'department_code',
        'division_head',
    ];

    public function getDivisions()
    {
        $divisionData = DB::table('divisions_table')
            ->select('*')
            ->where('status', 1)
            ->orderBy('division_name', 'ASC')
            ->get();
        return $divisionData;
    }
}
