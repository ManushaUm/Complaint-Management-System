<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\newComplaints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NewComplaintController extends Controller
{
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

        // Create a new complaint record
        newComplaints::create([
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
