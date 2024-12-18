<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class complaintType extends Model
{
    use HasFactory;
    public function getComplaintType()
    {
        $data = DB::table('complaint_types')
            ->select('*')
            ->where('status', 1)
            ->orderBy('complaint_type', 'ASC')
            ->get();
        return $data;
    }
}
