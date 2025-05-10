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
        // Validate incoming request
        $validated = $request->validate([
            'modalComplaintId' => 'required|integer',
            'department' => 'required|string',
            'div' => 'required|string',
            'priority' => 'required|string',
            'notes' => 'required|string',
        ]);

        // Find the complaint by ID
        $complaint = NewComplaint::find($validated['modalComplaintId']);
        if (!$complaint) {
            toastr()->error('Complaint not found.');
            return redirect()->back();
        }

        // Prepare data for update and log
        $Logdata = [
            'Reference_number' => $validated['modalComplaintId'],
            'Notes' => $validated['notes'],
            'Notes_by' => Auth::user()->emp_id,
        ];

        $departmentData = [
            'department' => $validated['department'],
            'division' => $validated['div'],
            'priority' => $validated['priority'],
        ];

        // Update complaint department info
        DB::table('new_complaints')
            ->where('id', $validated['modalComplaintId'])
            ->update($departmentData);

        // Log the complaint assignment
        $logId = DB::table('complaint_logs')->insertGetId($Logdata);

        // Update and save status (assuming method exists in model)
        $complaint->department = $validated['department']; // fixed wrong field used previously
        $complaint->updateStatus($validated['modalComplaintId']);
        $complaint->save();

        if ($logId) {
            toastr()->success('Complaint assigned successfully');
        } else {
            toastr()->error('Failed to log complaint assignment');
        }

        return redirect()->back();
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

            //update the main table date and status
            DB::table('complaint_main')
                ->where('reference', $id)
                ->update(['status' => 'in_progress', 'updated_at' => now()]);

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
        $data = $request->all();

        $complaint = ComplaintLog::where('Reference_number', $id)->latest()->first();

        if ($complaint) {
            if (Auth::user()->role == 'member') {
                $complaint->Comment = $validated['commentmessage-input'];
                $complaint->Comment_by = Auth::user()->emp_id;
                $complaint->is_action = 1;
                if (isset($data['solved']) && $data['solved'] == 'on') {
                    $complaint->Status = 'Solved';
                }
                $complaint->save();
            } elseif (Auth::user()->role == 'head') {
                $complaint->Comment = $validated['commentmessage-input'];
                $complaint->Comment_by = Auth::user()->emp_id;
                $complaint->is_action = 1;
                if (isset($data['solved']) && $data['solved'] == 'on') {
                    $complaint->Status = 'Solved';
                    //update the newComplaint table
                    $IntialComplaint = NewComplaint::find($id);
                    $IntialComplaint->complaint_status = 0;
                    $IntialComplaint->is_closed = 1;
                    $IntialComplaint->save();
                }
                $complaint->save();
            } elseif (Auth::user()->role == 'd-head') {
                //dd('check');
                $complaint->Comment = $validated['commentmessage-input'];
                $complaint->Comment_by = Auth::user()->emp_id;
                $complaint->is_action = 1;
                if (isset($data['solved']) && $data['solved'] == 'on') {
                    $complaint->Status = 'Solved';
                    //update the newComplaint table
                    $IntialComplaint = NewComplaint::find($id);
                    $IntialComplaint->complaint_status = 0;
                    $IntialComplaint->is_closed = 1;
                    $IntialComplaint->is_approved = 1;
                    $IntialComplaint->save();
                }
                //UPDATE THE main complaint TABLE
                DB::table('complaint_main')
                    ->where('reference', $id)
                    ->update(['status' => 'Closed', 'updated_at' => now()]);
                $complaint->save();
            }


            toastr()->success('Complaint Log added successfully');
            return redirect()->back()->with('success', 'Comment added successfully.');
        } else {
            return redirect()->back()->with('error', 'Complaint not found.');
        }
    }

    //Member Jobs Handling
    public function myJobs()
    {
        $latestLogs = new NewComplaint();
        $updatedComplaints = $latestLogs->getLatestLogs();
        $allLogs = $latestLogs->getAllLogs();
        //dd($allLogs);
        $ongoingComplaints = [];
        $completedComplaints = [];
        //members

        //divison heads

        //department heads

        foreach ($updatedComplaints as $complaint) {
            if ($complaint->Assigned_to == Auth::user()->emp_id) {
                if (($complaint->Status == 'in-progress' || $complaint->Status == 'Reopened') && $complaint->is_action == 0) {
                    $ongoingComplaints[] = $complaint;
                }
            }
        }

        foreach ($allLogs as $complaint) {
            if ($complaint->Assigned_to == Auth::user()->emp_id) {
                if ($complaint->is_action == 1) {
                    $completedComplaints[] = $complaint;
                }
            }
        }

        //dd($ongoingComplaints, $completedComplaints);
        return view('complaint.myjobs', compact('ongoingComplaints', 'completedComplaints'));
    }

    //Closed Jobs -view 
    public function closedJobs()
    {
        $closedComplaints = new NewComplaint();
        $closedComplaints = $closedComplaints->getLatestLogs();
        $complaints = [];
        $approvedJobs = [];

        //For division heads - closed complaints
        if (Auth::user()->role == 'head') {
            // dd($closedComplaints);
            foreach ($closedComplaints as $complaint) {
                if ($complaint->Status == 'Solved' && $complaint->is_closed == 0 &&  $complaint->division == Auth::user()->division) {
                    $complaints[] = $complaint;
                };
            }
            //dd($complaints);
            return view('complaint.closedjobs', compact('complaints'));
            //dd($complaints);
        } elseif (Auth::user()->role == 'd-head') {
            foreach ($closedComplaints as $complaint) {
                if ($complaint->is_closed == 1 && $complaint->is_approved == 0 && $complaint->complaint_status == 0) {
                    $complaints[] = $complaint;
                } elseif ($complaint->is_closed == 1 && ($complaint->is_approved == 1 || $complaint->is_approved == 2)) {
                    $approvedJobs[] = $complaint; //this one neglects the closed jobs
                }
            }
            return view('complaint.closedjobs', compact('complaints', 'approvedJobs'));
        } elseif (Auth::user()->role == 'admin') {
            //dept head approved jobs
            //get data from FinalLogs
            $complaintLogs = new FinalLog();
            $approvedFinalLogs = $complaintLogs->getComplaintDetails()->where('Status', 'Approved');
            $rejectedFinalLogs = $complaintLogs->getComplaintDetails()->where('Status', 'Rejected');
            $finalLogs = $complaintLogs->getComplaintDetails();

            //dd($approvedFinalLogs, $finalLogs);
            return view('complaint.closedjobs', compact('finalLogs', 'approvedFinalLogs', 'rejectedFinalLogs'));
        }

        // dd($complaints, Auth::user()->division);


    }

    //Close Complaint
    public function closeComplaint($id, Request $request)
    {
        if (Auth::user()->role == 'head') {

            //validate the request
            $validated =  $request->validate([
                'headNote' => 'required|string',
            ]);

            //need to save the request to complaint_log table

            $data = [
                'Reference_number' => $id,
                'Notes' => $request->headNote,
                'Notes_by' => Auth::user()->emp_id,
                'Assigned_to' => Auth::user()->emp_id,
                'Status' => 'Closed',
            ];

            if ($request->hasFile('formFileSm')) {
                $file = $request->file('formFileSm');
                $path = $file->store('uploads', 'public');
                $data['Attachment'] = $path;
            }


            $complaint = NewComplaint::find($id);

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
                //update the complaint_main table
                DB::table('complaint_main')
                    ->where('reference', $id)
                    ->update(['status' => 'Closed', 'completed_date' => now()->toDateString()]);
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
        //Reopen the complaint -DEPARTMENT HEAD
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
                    'Assigned_to' => $request->userAssignment,
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

                        toastr()->warning('Complaint opened successfully');
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
        } elseif (Auth::user()->role == 'head') {
            //dd(request()->all());
            //dd($request->file('formFileSm'), $request->all());
            //validate the request
            $validated =  $request->validate([
                'headNote' => 'required|string',
            ]);

            $data = [
                'Reference_number' => $id,
                'Notes' => $validated['headNote'],
                'Notes_by' => Auth::user()->emp_id,
                'Status' => 'Reopened',
                'Priority' => $request->priority,
            ];
            if ($request->hasFile('formFileSm')) {
                $file = $request->file('formFileSm');
                $path = $file->store('uploads', 'public');
                $data['Attachment'] = $path;
            }

            if ($request->userAssignment !== null) {
                $data['Assigned_to'] = $request->userAssignment;
            }
            //dd($data);
            $newId = ComplaintLog::create($data);
            if ($newId) {
                toastr()->warning('Complaint opened successfully');
                return redirect()->back()->with('success', 'Complaint Reopened successfully.');
            } else {
                return redirect()->back()->with('error', 'Error Reopening.');
            }
        } elseif (Auth::user()->role == 'admin') {
            //dd(request()->all());
            //validate the request
            $validated =  $request->validate([
                'headNote' => 'required|string',
            ]);

            $data = [
                'Reference_number' => $id,
                'Notes' => $validated['headNote'],
                'Notes_by' => Auth::user()->emp_id,
                'Status' => 'Reopened',
                'Priority' => $request->priority,
            ];
            if ($request->hasFile('formFileSm')) {
                $file = $request->file('formFileSm');
                $Attachment = $file->store('uploads', 'public');
                $data['Attachment'] = $Attachment;
            }
            if ($request->userAssignment !== null) {
                $data['Assigned_to'] = $request->userAssignment;
            }
            //dd($data);
            //IMPLEMENT ADMIN REOPEN 
            try {
                //new complaints table
                NewComplaint::find($id)->update(['is_approved' => 0, 'is_closed' => 0, 'complaint_status' => 1]);
                //add complaint log
                ComplaintLog::create($data);

                //update the complaint_main table
                DB::table('complaint_main')
                    ->where('reference', $id)
                    ->update(['status' => 'in_progress', 'completed_date' => null]);

                toastr()->warning('Complaint opened successfully');
                return redirect()->back()->with('success', 'Successfully Reopened.');
            } catch (\Exception $e) {
                toastr()->error('Error Reopening.');
                return redirect()->back()->with('error', 'Error Reopening.');
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
            //update the complaint_main table
            DB::table('complaint_main')
                ->where('reference', $id)
                ->update(['status' => 'rejected', 'completed_date' => now()->toDateString()]);
            FinalLog::create($data);
            NewComplaint::find($id)->update(['is_approved' => 2]);


            return redirect()->back()->with('success', 'Complaint Rejected.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Rejecting.');
        }
    }
}
