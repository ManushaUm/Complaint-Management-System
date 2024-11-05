<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class newComplaints extends Model
{
    protected $fillable = [
        'name',
        'insured',
        'relation',
        'address',
        'contact_no',
        'email',
        'customer_type',
        'policy_number',
        'complaint_date',
        'complaint_detail',
        'attachment',

    ];

    public function getComplaintType()
    {
        $data = DB::table('complaint_types')
            ->select('*')
            ->where('status', 1)
            ->orderBy('complaint_type', 'ASC')
            ->get();
        return $data;
    }

    public function getTableData()
    {
        $Tabledata = DB::table('new_complaints')
            ->select('*')
            ->get();
        return $Tabledata;
    }
}
