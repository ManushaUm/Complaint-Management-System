<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Fetch the count 
        $newComplaintsCount = DB::table('new_complaints')->count();
        $pendingComplaintsCount = DB::table('new_complaints')->where('complaint_status', 0)->count();
        $assignedComplaintsCount = DB::table('new_complaints')->where('complaint_status', 1)->count();

        // Pass to view
        return view('dashboard', [
            'newComplaintsCount' => $newComplaintsCount,
            'pendingComplaintsCount' => $pendingComplaintsCount,
            'assignedComplaintsCount' => $assignedComplaintsCount
        ]);
    }
}
