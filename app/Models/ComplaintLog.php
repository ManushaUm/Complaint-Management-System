<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintLog extends Model
{
    protected $table = 'complaint_logs';
    use HasFactory;
    protected $fillable = [
        'Reference_number',
        'Department',
        'Sub_division',
        'Notes',
        'Assigned_to',
        'Status',
        'Priority',
        'Comment',
    ];
    public $timestamps = true;
}
