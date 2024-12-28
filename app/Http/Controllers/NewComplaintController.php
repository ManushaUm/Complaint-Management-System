<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\newComplaints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewComplaintController extends Controller
{
    public function lodgeNew()
    {
        $newComplaint = new newComplaints();
        $getComplaintType = $newComplaint->getComplaintType();
        // dd($getComplaintType);
        return view('newcomplaint', ['complaintTypes' => $getComplaintType]);
    }



    public function store(Request $request)
    {
        //check the input
        //($request->input());
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
        $attachment = $request->file('attachment') ? $request->file('attachment')->store('public/attachments') : null;

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

        $departments = new Departments();
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
    public function getAttachment($id)
    {
        Log::info('getAttachment called with ID: ' . $id);

        $complaint = DB::table('new_complaints')->where('id', $id)->first();

        if ($complaint && $complaint->attachment) {
            Log::info('Attachment found: ' . $complaint->attachment);

            // Use Storage::url to generate the correct URL
            $attachmentUrl = Storage::url($complaint->attachment);

            return response()->json([
                'attachment' => $attachmentUrl
            ]);
        } else {
            Log::error('Attachment not found for ID: ' . $id);
            return response()->json(['error' => 'Attachment not found'], 404);
        }
    }
}
