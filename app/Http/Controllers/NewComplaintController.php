<?php

namespace App\Http\Controllers;

use App\Models\complaintType;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewComplaintController extends Controller
{
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
        $complaints = DB::table('new_complaints')->get();
        $assignedComplaints = DB::table('as_complaints')->get();

        $departments = new Department();
        $getDepartmentName = $departments->getDepartment();
        $getDivisionName = $departments->getDivision();



        //dd($getDivisionName);
        return view('viewcomplaint', [
            'complaints' => $complaints,
            'assignedComplaints' => $assignedComplaints,
            'departmentNames' => $getDepartmentName,
            'divisionNames' => $getDivisionName

        ]);
    }
}
