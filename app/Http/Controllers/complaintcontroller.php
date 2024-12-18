<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\complaintstatus;
use App\Models\NewComplaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class complaintcontroller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'location' => 'required',
            'branch' => 'required',
            'resperson' => 'required',
            'altperson' => 'required',
            'pred' => 'required',
            'description' => 'required',
        ]);

        $data = array(
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'location' => $request->location,
            'branch' => $request->branch,
            'resperson' => $request->resperson,
            'altperson' => $request->altperson,
            'pred' => $request->pred,
            'description' => $request->description,
        );

        $id = DB::table('complaint_status')->insertGetId($data);

        if ($id) {
            return redirect()->back()->with('success', 'Complaint successfully logged');
        } else {
            return redirect()->back()->with('error', 'Error logged');
        }
    }

    public function typeview()
    {
        $category = DB::table('complaint_type')->get();
        return $category;
    }

    public function assignComplaint(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'modalComplaintId' => 'required|integer',
        ]);

        // Find the complaint by ID
        $complaint = newComplaint::find($request->modalComplaintId);

        // Check if complaint exists
        if (!$complaint) {
            return redirect()->back()->with('error', 'Complaint not found.');
        }

        // Update the status
        $complaint->updateStatus($request->modalComplaintId);

        // Redirect with success message
        return redirect()->back()->with('success', 'Complaint assigned successfully.');
    }
}
