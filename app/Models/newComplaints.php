<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'notify_customer'
    ];
}
