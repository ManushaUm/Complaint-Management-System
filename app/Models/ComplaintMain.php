<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintMain extends Model
{
    protected $table = 'complaint_main';

    public $timestamps = true;

    protected $fillable = [
        'reference',
        'complaint_date',
        'completed_date',
        'status',
    ];

    public function complaintDetails()
    {
        //
    }
}
