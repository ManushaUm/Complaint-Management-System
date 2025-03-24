<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
