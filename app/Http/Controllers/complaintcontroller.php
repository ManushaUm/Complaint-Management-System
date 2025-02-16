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
        //dd($request->all()); //checked
        // Validate incoming request
        $request->validate([
            'modalComplaintId' => 'required|integer',
            'dept_id' => 'required|string',
            'div_name' => 'required|string',
            'district' => 'required|string',
            'branch' => 'required|string',
            'notes' => 'required|string',
        ]);

        // Find the complaint by ID
        $complaint = NewComplaint::find($request->modalComplaintId);

        // Check if complaint exists
        if (!$complaint) {
            return redirect()->back()->with('error', 'Complaint not found.');
        }

        //create the data array for the complaint
        $data = array(
            'Reference_number' => $request->modalComplaintId,
            'Department' => $request->dept_id,
            'Sub_division' => $request->div_name,
            'Notes' => $request->notes,
            //need to update priority here
        );

        //dd('data array', $data); //checked

        //store to log
        $id = DB::table('complaint_logs')->insertGetId($data);



        // Update the department and status
        $complaint->department = $request->dept_id;
        $complaint->updateStatus($request->modalComplaintId);

        // Save the changes
        $complaint->save();

        // Redirect with success message
        if ($id) {
            return redirect()->back()->with('success', 'Complaint assigned successfully.');
        } else {
            return redirect()->back()->with('error', 'Error assigning complaint');
        }
    }

    public function getComplaintDetails($id)
    {
        //dd($id);
        $complaint = NewComplaint::find($id);
        //dd($complaint);
        return view('complaint.complaintdetail', compact('complaint'));
    }
}
