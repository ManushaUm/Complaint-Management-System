<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FinalLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'remarks',
        'remarks_by',
        'status',
        'attachment_path',
        'attachment_name',

    ];

    public function getTableData()
    {
        $Tabledata = DB::table('final_logs')
            ->select('*')
            ->get();
        return $Tabledata;
    }

    public function getComplaintDetails()
    {
        $complaints = DB::table('final_logs')
            ->leftJoin('new_complaints', 'final_logs.reference', '=', 'new_complaints.id')
            ->select(
                'final_logs.reference as Reference_number',
                'final_logs.status as Status',
                'final_logs.remarks as Notes',
                'final_logs.remarks_by as Notes_by',
                'final_logs.attachment_path as Attachment_path',
                'final_logs.attachment_name as Attachment_name',
                'new_complaints.*',
            )
            ->get();
        return $complaints;
    }
}
