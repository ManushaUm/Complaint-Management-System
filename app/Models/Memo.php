<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $table = 'memos'; // Ensure it points to the correct table

    protected $fillable = [
        'title',
        'content',
        'send_to',
        'specific_employee',
        'timer',
        'reply',
        'read',
    ];

    public $timestamps = true; // Ensure timestamps are enabled
}
