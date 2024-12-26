<?php

namespace App\Http\Controllers;

use App\Models\HR;
use Illuminate\Http\Request;

class HRController extends Controller
{
    //
    public function index()
    {
        $hrData = HR::all();
        dd($hrData);
    }
}
