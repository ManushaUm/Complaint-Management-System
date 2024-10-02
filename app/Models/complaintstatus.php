<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintstatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'subcategory',
        'location',
        'branch',
        'resperson',
        'altperson',
        'pred',
        'description',
    ];
}
