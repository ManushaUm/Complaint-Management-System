<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branch = new Branch();
        $branchData = $branch->getBranchData();
        return $branchData;
    }
}
