<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branchs';
    protected $fillable = [
        'branch_name',
        'branch_code',
        'branch_head',
        'branch_email',
        'branch_contact',
        'branch_address',
    ];

    public $timestamps = true;

    public function getBranchData()
    {
        return self::all();
    }

    public function getBranchById($id)
    {
        return self::find($id);
    }
}
