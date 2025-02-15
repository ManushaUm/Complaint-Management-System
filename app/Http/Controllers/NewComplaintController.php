<?php

namespace App\Http\Controllers;

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
        $getComplaintType = $newComplaint->getComplaintType();
        // dd($getComplaintType);
        return view('newcomplaint', ['complaintTypes' => $getComplaintType]);
    }



    public function store(Request $request)
    {
        //check the input
        //dd($request->input());
        // Validate the request

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
            'attachment' => 'nullable|file|max:2048',

        ]);

        // Handle file upload
        $attachment = $request->file('attachment') ? $request->file('attachment')->store('attachments') : null;

        $data = array(
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
            'attachment' => $attachment,
        );

        $id = DB::table('new_complaints')->insertGetId($data);

        if ($id) {
            return redirect()->back()->with('success', 'Complaint successfully logged');
        } else {
            return redirect()->back()->with('error', 'Error logged');
        }
    }


    public function viewcomplaint()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $complaints = DB::table('new_complaints')->get();
        } else {
            $complaints = DB::table('new_complaints')->where('department', $user->department)->get();
        }

        $departments = new Department();
        $getDepartmentName = $departments->getDepartment();
        $getDivisionName = $departments->getDivision();

        $complaintLogs = DB::table('complaint_logs')->get();

        return view('viewcomplaint', [
            'complaints' => $complaints,
            'departmentNames' => $getDepartmentName,
            'divisionNames' => $getDivisionName,
            'complaintLogs' => $complaintLogs
        ]);
    }

    public function complaintLogData() {}
}
