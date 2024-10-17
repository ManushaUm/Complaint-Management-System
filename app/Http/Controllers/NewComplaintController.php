<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\newComplaints;
use Illuminate\Support\Facades\Log;

class NewComplaintController extends Controller
{
<<<<<<< Updated upstream
=======
    public function lodgeNew()
    {
        $newComplaint = new newComplaints();
        $getComplaintType = $newComplaint->getComplaintType();
        // dd($getComplaintType);
        return view('newcomplaint', ['complaintTypes' => $getComplaintType]);
    }

    public function verifyPolicy(Request $request)
    {
        // Validate the incoming request to ensure the policy_number field is provided
        $request->validate([
            'policy_number' => 'required|string|max:255',
        ]);

        // Check if the policy number exists in the 'userinfo' table
        $policyExists = DB::table('userinfo')
            ->where('policy_number', $request->policy_number)
            ->exists();

        // Return the result as a JSON response
        return response()->json([
            'exists' => $policyExists,
        ]);
    }

>>>>>>> Stashed changes
    public function store(Request $request)
    {
        // Incoming data validation
        $request->validate(
            [
                'name' => 'required',
                'insured' => 'required|in:Yes,No',
                'relation' => 'required_if:insured,No|string',
                'address' => 'required',
                'contact_no' => 'required',
                'email' => 'required|email',
                'customer_type' => 'required',
                'complaint_date' => 'required|date',
                'complaint_detail' => 'required',
                'attachment' => 'nullable|file|max:2048',
            ]
        );

        // Check if the customer needs to be notified
        $notifyCustomer = $request->has('notify_customer') ? 'Customer informed' : null;

        // Log customer notification if applicable
        if ($notifyCustomer) {
            Log::info('Customer has been notified for the complaint.');
        }

<<<<<<< Updated upstream
        // Create a new complaint record
        newComplaints::create([
=======
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
>>>>>>> Stashed changes
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
            'attachment' => $request->file('attachment') ? $request->file('attachment')->store('attachments') : null,
            'notify_customer' => $notifyCustomer
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Complaint successfully logged');
    }
}
