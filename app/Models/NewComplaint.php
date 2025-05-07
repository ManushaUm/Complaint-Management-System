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
        'branch',
        'complaint_date',
        'complaint_detail',
        'attachment',
        'priority',
        'department',
        'division',
        'is_closed',
        'is_approved',
        'logged_by',
        'complaint_status',

    ];

    public $timestamps = true;

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

    public function getLatestLogs()
    {
        $latestLogs = DB::table('new_complaints as nc')
            ->leftJoin(DB::raw('(
                SELECT reference_number, MAX(updated_at) as latest_date
                FROM complaint_logs
                GROUP BY reference_number
            ) as latest_logs'), 'nc.id', '=', 'latest_logs.reference_number')
            ->leftJoin('complaint_logs as cl', function ($join) {
                $join->on('latest_logs.reference_number', '=', 'cl.reference_number')
                    ->on('latest_logs.latest_date', '=', 'cl.updated_at');
            })
            ->select('nc.*', 'cl.*')
            ->get();

        return $latestLogs;
    }

    public function getAllLogs()
    {
        $allLogs = DB::table('new_complaints')
            ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
            ->select('new_complaints.*', 'complaint_logs.*')
            ->get();

        return $allLogs;
    }
}
