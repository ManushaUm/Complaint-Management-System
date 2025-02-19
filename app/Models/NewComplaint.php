<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewComplaint extends Model
{
    use HasFactory;
    protected $table = 'new_complaints';
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
        'complaint_status',
        'department',
        'logged_by',

    ];

    public $timestamps = false;



    public function getTableData()
    {
        $Tabledata = DB::table('new_complaints')
            ->select('*')
            ->get();
        return $Tabledata;
    }

    public function getAssingedData()
    {
        $assignedData = DB::table('as_complaints')
            ->select('*')
            ->get();
        return $assignedData;
    }

    public function updateStatus($id)
    {
        $complaint = self::find($id);
        if ($complaint) {
            $complaint->complaint_status = 1;
            $complaint->save();
            return $complaint;
        }
        return false;
        // $updateStatus = DB::table('new_complaints')
        //     ->where('id', $id)
        //     ->update(['complaint_status' => 1]);
        // return $updateStatus;
    }
}
