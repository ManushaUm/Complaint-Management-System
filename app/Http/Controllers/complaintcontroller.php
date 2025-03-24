<?php

namespace App\Http\Controllers;

use App\Models\ComplaintLog;
use Illuminate\Http\Request;
use App\Models\FinalLog;
use App\Models\NewComplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            $complaint->Status = 'in-progress';
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
            $complaint->Comment = $validated['commentmessage-input'];
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
        $updatedComplaints = DB::table('new_complaints as nc')
            ->leftJoin(DB::raw('(
            SELECT reference_number, MAX(updated_at) as latest_date
            FROM complaint_logs
            GROUP BY reference_number
        ) as latest_logs'), 'nc.id', '=', 'latest_logs.reference_number')
            ->leftJoin('complaint_logs as cl', function ($join) {
                $join->on('latest_logs.reference_number', '=', 'cl.reference_number')
                    ->on('latest_logs.latest_date', '=', 'cl.updated_at');
            })
            ->select('nc.*', 'cl.*')
            ->get();
        //dd($updatedComplaints);
        $complaints = [];
        foreach ($updatedComplaints as $complaint) {
            //update here with the logic =================<<<
            if ($complaint->Assigned_to == Auth::user()->emp_id && ($complaint->Status !== 'Solved' && $complaint->Status !== 'Closed')) {
                $complaints[] = $complaint;
            };
        }
        // dd($complaints);
        return view('complaint.myjobs', compact('complaints'));
    }

    //Closed Jobs Handling
    public function closedJobs()
    {
        //dd('closed jobs');
        $closedComplaints = new NewComplaint();
        $closedComplaints = $closedComplaints->getLatestLogs();
        //dd($closedComplaints);
        $complaints = [];
        foreach ($closedComplaints as $complaint) {
            if ($complaint->Status == 'Solved' &&  $complaint->department == Auth::user()->department && $complaint->is_closed !== 1) {
                $complaints[] = $complaint;
            };
        }
        //dd($complaints);

        return view('complaint.closedjobs', compact('complaints'));
    }

    //Close Complaint
    public function closeComplaint($id, Request $request)
    {
        if (Auth::user()->role == 'head') {
            dd($request->all());
            //validate the request
            $validated =  $request->validate([
                'headNote' => 'required|string',
            ]);
            // dd($validated);
            //need to save the request to complaint_log table
            $data = array(
                'Reference_number' => $id,
                'Notes' => $request->headNote,
                'Notes_by' => Auth::user()->emp_id,
                'Assigned_to' => Auth::user()->emp_id,
                'Status' => 'Closed',

            );
            //dd($data);
            $complaint = NewComplaint::find($id);
            //dd($complaint);
            if ($complaint) {
                $complaint->is_closed = 1;
                $complaint->complaint_status = 0;
                $complaint->save();
                DB::table('complaint_logs')->insertGetId($data);
                return redirect()->back()->with('success', 'Complaint closed successfully.');
            } else {
                return redirect()->back()->with('error', 'Complaint not found.');
            }
        } elseif (Auth::user()->role == 'd-head') {

            //dd($request->file('formFileSm'), $request->all());
            //validate the request
            $validated =  $request->validate([
                'headNote' => 'required|string',
            ]);

            $data = [
                'reference' => $id,
                'remarks' => $validated['headNote'],
                'remarks_by' => Auth::user()->emp_id,
                'status' => 'Approved',
            ];

            if ($request->hasFile('formFileSm')) {

                $file = $request->file('formFileSm');
                $filename = $file->getClientOriginalName();
                $path = $file->store('uploads', 'public');

                $data['attachment_path'] = $path;
                $data['attachment_name'] = $filename;
            }
            //dd($data);

            try {
                FinalLog::create($data);
                NewComplaint::find($id)->update(['is_approved' => 1]);

                return redirect()->back()->with('success', 'Successfully Approved.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error Approving.');
            }
        }
    }

    //Reopen the complaint
    public function  reopenComplaint(Request $request, $id)
    {
        //dd($request->all());
        if (Auth::user()->role == 'd-head') {

            $validated = $request->validate([
                'headNote' => 'required|string',
            ]);
            if ($validated) {
                $data = [
                    'Reference_number' => $id,
                    'Notes' => $validated['headNote'],
                    'Notes_by' => Auth::user()->emp_id,
                    'Assigned_to' => $request->checkbox,
                    'Status' => 'Reopened',
                ];

                if ($request->hasFile('formFileSm')) {

                    $file = $request->file('formFileSm');
                    $Attachment = $file->store('uploads', 'public');

                    $data['Attachment'] = $Attachment;
                }

                //dd($data);
                try {
                    $complaint = NewComplaint::find($id);
                    if ($complaint) {
                        $complaint->is_closed = 0;
                        $complaint->complaint_status = 1;
                        $complaint->save();
                        ComplaintLog::create($data);
                        return redirect()->back()->with('success', 'Complaint Logged successfully.');
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Error Logging.');
                }
            } else {
                //extract data from dataRecord
                $dataRecord = $request->dataRecord;
                $assignedTo = $dataRecord['Assigned_to'];
                //dd($assignedTo);

                //validate the request
                $validated =  $request->validate([
                    'headNote' => 'required|string',
                ]);
                //data array
                $data = array(
                    'Reference_number' => $id,
                    'Notes' => $request->headNote,
                    'Notes_by' => Auth::user()->emp_id,
                    'Assigned_to' => $assignedTo,
                    'Status' => 'Reopened',
                );

                $complaint = NewComplaint::find($id);

                if ($complaint) {
                    $complaint->is_closed = 0;
                    $complaint->complaint_status = 1;
                    $complaint->save();
                    DB::table('complaint_logs')->insertGetId($data);
                    return redirect()->back()->with('success', 'Complaint Logged successfully.');
                } else {
                    return redirect()->back()->with('error', 'Complaint not found.');
                }
            }
        }
    }

    //Reject the complaint
    public function rejectComplaint(Request $request, $id)
    {
        //dd($request->all());
        //validate the request
        $validated =  $request->validate([
            'headNote' => 'required|string',
        ]);

        //data array
        $data = array(
            'reference' => $id,
            'remarks' => $request->headNote,
            'remarks_by' => Auth::user()->emp_id,
            'status' => 'Rejected',
        );

        //file upload
        if ($request->hasFile('formFileSm')) {

            $file = $request->file('formFileSm');
            $filename = $file->getClientOriginalName();
            $Attachment = $file->store('uploads', 'public');

            $data['attachment_path'] = $Attachment;
            $data['attachment_name'] = $filename;
        }
        //dd($data);
        //insert data into final_logs table and update new_complaints
        try {
            FinalLog::create($data);
            NewComplaint::find($id)->update(['is_approved' => 1]);

            return redirect()->back()->with('success', 'Complaint Rejected.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Rejecting.');
        }
    }
}
