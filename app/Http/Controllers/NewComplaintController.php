<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\newComplaints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        // Create the new complaint
        // newComplaints::create([
        //     'name' => $request->name,
        //     'insured' => $request->insured === 'Yes',
        //     'relation' => $request->insured === 'No' ? $request->relation : null,
        //     'address' => $request->address,
        //     'contact_no' => $request->contact_no,
        //     'email' => $request->email,
        //     'complaint_type' => $request->complaint_type,
        //     'policy_number' => $request->policy_number,
        //     'complaint_date' => $request->complaint_date,
        //     'complaint_detail' => $request->complaint_detail,
        //     'attachment' => $attachment,
        // ]);

        $data = array(
            'name' => $request->name,
            'insured' => $request->insured === 'Yes',
            'relation' => $request->insured === 'No' ? $request->relation : null,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'complaint_type' => $request->customer_type,
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
        //dd($complaints);
        return view('viewcomplaint', ['complaints' => $complaints]);
    }
}
