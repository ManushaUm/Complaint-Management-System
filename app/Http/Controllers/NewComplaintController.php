<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\complaintType;
use App\Models\Department;
use App\Models\NewComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NewComplaintController extends Controller
{
    public function show($policy_number)
    {
        // Find the complaint by policy number
        $complaint = NewComplaint::where('policy_number', $policy_number)->first(); // This will return a 404 if not found

        // Pass the complaint data to the view
        return view('showComplaint', compact('complaint'));
    }

    public function searchForm()
    {
        return view('searchcomplaints');
    }


    public function search(Request $request)
    {

        dd($request);
        $query = DB::table('new_complaints');

        if ($request->customer_name) {
            $query->where('name', 'like', '%' . trim($request->customer_name) . '%');
        }

        if ($request->policy_number) {
            $query->where('policy_number', 'like', '%' . $request->policy_number . '%');
        }
        if ($request->complaint_date) {
            $query->whereDate('complaint_date', $request->complaint_date);
        }
        if ($request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $complaints = $query->get();
        return view('searchcomplaints', ['complaints' => $complaints]);
    }



    public function verifyUser(Request $request)
    {
        // Validate that the policy_number field exists
        $request->validate([
            'user_id' => 'required|string|max:255',
        ]);

        // Check if the policy number exists in the 'userinfo' table
        $userExists = DB::table('user_info')
            ->where('user_id', $request->user_id)
            ->exists();

        // Return the response as JSON to be handled by the AJAX call
        return response()->json([
            'exists' => $userExists,
        ]);
    }

    public function lodgeNew()
    {

        $newComplaint = new complaintType();
        $complaintTypes = $newComplaint->getComplaintType();
        $branch = new Branch();
        $branchData = $branch->getBranchData();
        //dd($branchData);
        return view('newcomplaint', [
            'branchData' => $branchData,
            'complaintTypes' => $complaintTypes,
        ]);
    }



    public function store(Request $request)
    {
        //dd($request->all());


        $request->validate([
            'name' => 'required|string|max:255',
            'insured' => 'required|in:Yes,No',
            'relation' => 'required_if:insured,No|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|numeric',
            'email' => 'required|email|max:255',
            'customer_type' => 'required|string|max:255',
            'policy_number' => 'required|string|max:255',
            'complaint_date' => 'required|date',
            'complaint_detail' => 'required|string',


        ]);

        $data = [
            'name' => $request->name,
            'insured' => $request->insured === 'Yes',
            'relation' => $request->insured === 'No' ? $request->relation : null,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'customer_type' => $request->customer_type,
            'policy_number' => $request->policy_number,
            'complaint_date' => $request->complaint_date,
            'complaint_detail' => $request->complaint_detail,

        ];
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $Attachment = $file->store('uploads', 'public');
            $data['Attachment'] = $Attachment;
        }

        $id = DB::table('new_complaints')->insertGetId($data);



        if ($id) {
            toastr()->success('Complaint successfully logged');
            return redirect()->back()->with('success', 'Complaint successfully logged');
        } else {
            toastr()->error('Error in logging complaint');
            return redirect()->back()->with('error', 'Error logged');
        }
    }


    public function viewcomplaint()
    {
        $newComplaints = [];
        $assignedComplaints = []; //assigned to department/division & started by employees
        $closedComplaints = [];
        $receivedComplaints = []; //complaints assigned to relevent department but not started
        $solvedComplaints = [];
        $adminAssigned = []; //admin assignments
        $adminOngoing = [];

        $latestComplaints = [];
        $user = Auth::user();
        if ($user->role === 'admin') {
            $complaints = DB::table('new_complaints')->get();
            $alatestLogs = new NewComplaint();
            $adminLatestComplaints = $alatestLogs->getLatestLogs();
        } else {

            $latestLogs = new NewComplaint();
            $latestComplaints = $latestLogs->getLatestLogs();
            $complaints = DB::table('new_complaints')->where('department', $user->department)->get();
            $adminLatestComplaints = $latestLogs->getLatestLogs();
        }
        //dd($adminLatestComplaints);
        $departments = new Department();
        $getDepartmentName = $departments->getDepartment();
        $getDivisionName = $departments->getDivision();

        $complaintLogs = DB::table('complaint_logs')->get();

        $updatedComplaints = DB::table('new_complaints')
            ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
            ->select('new_complaints.*', 'complaint_logs.*')
            ->get();
        //dd($updatedComplaints);



        foreach ($complaints as $complaint) {
            if ($complaint->is_closed == 0 && $complaint->complaint_status == 0) {
                $newComplaints[] = $complaint;
            }
        }
        foreach ($adminLatestComplaints as $complaint) {
            if ($complaint->is_approved == 0 && $complaint->Status == 'Received' && $complaint->is_closed == 0) {
                $adminAssigned[] = $complaint;
            } elseif ($complaint->is_approved == 0 && ($complaint->Status == 'in-progress' || $complaint->Status == 'Reopened') && $complaint->is_closed == 0) {
                $adminOngoing[] = $complaint;
            }
        }

        //NO action on ADMIN HERE 
        foreach ($latestComplaints as $complaint) {
            if ($complaint->is_approved == 0 && ($complaint->Status == 'in-progress' || $complaint->Status == 'Reopened') && $complaint->is_action == 0) {
                if ($user->role == 'head') {
                    if ($complaint->division == $user->division) {
                        $assignedComplaints[] = $complaint;
                    }
                } elseif ($user->role == 'd-head') {
                    if ($complaint->department == $user->department) {
                        $assignedComplaints[] = $complaint;
                    }
                } else {
                    $assignedComplaints[] = $complaint;
                }
            } elseif ($complaint->complaint_status == 1 && $complaint->is_closed == 0 && $complaint->Status == 'Received' && $complaint->is_approved == 0) {
                if ($user->role == 'admin') {
                    $receivedComplaints[] = $complaint;
                } elseif ($user->role == 'member' || $user->role == 'head') {
                    if ($complaint->division == $user->division) {
                        $receivedComplaints[] = $complaint;
                    }
                } elseif ($user->role == 'd-head') {
                    if ($complaint->department == $user->department) {
                        $receivedComplaints[] = $complaint;
                    }
                }
            } elseif ($complaint->is_closed == 0 && $complaint->complaint_status == 1 && $complaint->Status == 'Solved' && $complaint->is_approved == 0) {
                $solvedComplaints[] = $complaint;
            } elseif ($complaint->is_closed == 1 && $complaint->complaint_status == 0 && $complaint->is_approved == 0) {
                $closedComplaints[] = $complaint;
            } elseif ($complaint->Status == 'Received') {
                $adminAssigned[] = $complaint;
            }
        }


        //dd($adminAssigned);

        return view('viewcomplaint', [
            'updatedComplaints' => $updatedComplaints,
            'newComplaints' => $newComplaints,
            'assignedComplaints' => $assignedComplaints,
            'receivedComplaints' => $receivedComplaints,
            'solvedComplaints' => $solvedComplaints,
            'closedComplaints' => $closedComplaints,
            'complaints' => $complaints,
            'departmentNames' => $getDepartmentName,
            'divisionNames' => $getDivisionName,
            'complaintLogs' => $complaintLogs,
            'adminAssigned' => $adminAssigned,
            'adminOngoing' => $adminOngoing
        ]);
    }



    public function completedJobs()
    {

        $latestComplaints = DB::table('new_complaints')
            ->leftJoin('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
            ->get();
        //$complaints = DB::table('new_complaints')->where('department', $user->department)->get();
        //dd($latestComplaints);
        $complaints = [];
        foreach ($latestComplaints as $complaint) {
            if ($complaint->Assigned_to == Auth::user()->emp_id && ($complaint->Status == 'Solved' || $complaint->Status == 'Closed')) {
                $complaints[] = $complaint;
            }
        }
        //dd($complaints);
        $departments = new Department();
        $getDepartmentName = $departments->getDepartment();
        $getDivisionName = $departments->getDivision();

        return view('complaint.completedjobs', ['complaints' => $complaints, 'departmentNames' => $getDepartmentName, 'divisionNames' => $getDivisionName]);
    }
}
