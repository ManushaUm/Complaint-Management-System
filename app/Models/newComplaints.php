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
        $data = DB::table('complaint_type')
            ->select('*')
            ->where('status', 1)
            ->orderBy('complaint_type', 'ASC')
            ->get();
        return $data;
    }
}
