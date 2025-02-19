<?php

namespace App\Http\Controllers;

use App\Models\ComplaintLog;
use Illuminate\Http\Request;
use App\Models\complaintstatus;
use App\Models\NewComplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\error;

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

        //dd($complaint);
        // Check if complaint exists
        if (!$complaint) {
            return redirect()->back()->with('error', 'Complaint not found.');
        }

        //create the data array for the complaint
        $Logdata = array(
            'Reference_number' => $request->modalComplaintId,
            //'Department' => $request->dept_id,
            //'Sub_division' => $request->div_name,
            'Notes' => $request->notes,
            //need to update priority here
        );

        $departmentData = array(
            'department' => $request->dept_id,
            'division' => $request->div_name,
        );

        // Update the new_complaints table with the department data
        DB::table('new_complaints')
            ->where('id', $request->modalComplaintId)
            ->update($departmentData);

        //dd('data array', $data); //checked

        //store to log
        $id = DB::table('complaint_logs')->insertGetId($Logdata);




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
        //get the initalization data of the complaint
        $prevData = DB::table('new_complaints')
            ->select('*')
            ->where('id', $id)
            ->get();


        $newData = DB::table('complaint_logs')->select('*')->where('Reference_number', $id)->get();
        return view('complaint.complaintdetail', compact('prevData', 'newData'));
    }

    public function assignJob($id)
    {

        //dd($id);
        $complaint = ComplaintLog::where('Reference_number', $id)->latest()->first();
        //dd($complaint);
        $emp_id = Auth::user()->emp_id;
        //dd($emp_id);
        //update the relevent row, assinged_to  column by emp_id
        $complaint->assigned_to = $emp_id;
        $complaint->save();
        return view('complaint.complaintdetail');
    }
}
