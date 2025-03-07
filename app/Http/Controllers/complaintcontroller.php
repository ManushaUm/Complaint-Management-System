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
            'Notes' => $request->notes,

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
        if ($newData) {
            return view('complaint.complaintdetail', compact('prevData', 'newData'));
        } else {

            return redirect()->back()->with('error', 'Complaint not found.');
        }
    }

    public function assignJob($id)
    {
        $complaint = ComplaintLog::where('Reference_number', $id)->latest()->first();
        if ($complaint) {
            $emp_id = Auth::user()->emp_id;
            //update the relevent row, assinged_to  column by emp_id
            $complaint->assigned_to = $emp_id;
            $complaint->Status = 'assigned';
            $complaint->save();
            //update the new_complaints table status
            $Intialcomplaint = NewComplaint::find($id);
            $Intialcomplaint->complaint_status = 1;
            $Intialcomplaint->is_closed = 0;
            $Intialcomplaint->save();

            return redirect()->back()->with('success', 'Job assigned successfully.');
        } else {
            return redirect()->back()->with('error', 'Complaint not Found. Please contact your administrator');
        }
    }

    public function addComment($id, Request $request)
    {

        // Validate the request
        $validated = $request->validate([
            'commentmessage-input' => 'required|string',

        ]);

        //dd($validated);

        $data = $request->all();
        $complaint = ComplaintLog::where('Reference_number', $id)->latest()->first();

        if ($complaint) {
            $complaint->Comment = $data['commentmessage-input'];
            $complaint->Comment_by = Auth::user()->emp_id;

            if (isset($data['solved']) && $data['solved'] == 'on') {
                $complaint->Status = 'Solved';
            }

            $complaint->save();

            return redirect()->back()->with('success', 'Comment added successfully.');
        } else {
            return redirect()->back()->with('error', 'Complaint not found.');
        }
    }

    //Member Jobs Handling
    public function myJobs()
    {
        $updatedComplaints = DB::table('new_complaints')->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')->select('new_complaints.*', 'complaint_logs.*')->get();
        //dd($updatedComplaints);
        foreach ($updatedComplaints as $complaint) {
            if ($complaint->Assigned_to == Auth::user()->emp_id) {
                $complaints[] = $complaint;
            };
        }
        //dd($complaints);
        return view('complaint.myjobs', compact('complaints'));
    }

    //Closed Jobs Handling
    public function closedJobs()
    {
        $closedComplaints = DB::table('new_complaints')->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')->select('new_complaints.*', 'complaint_logs.*')->get();

        foreach ($closedComplaints as $complaint) {
            if ($complaint->Status == 'Solved' && $complaint->department == Auth::user()->department) {
                $complaints[] = $complaint;
            };
        }


        return view('complaint.closedjobs', compact('complaints'));
    }

    //Close Complaint
    public function closeComplaint($id, Request $request)
    {
        dd($request->all());
    }
}
