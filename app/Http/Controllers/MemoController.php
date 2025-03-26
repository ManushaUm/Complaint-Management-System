<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HR; // Import the HR model
use App\Models\Memo; // Import the Memo model

class MemoController extends Controller
{
    public function store(Request $request)
    {
        DB::table('memos')
            ->where('timer', '<', now()) // Delete memos where timer has expired
            ->delete();

        $validatedData = $request->validate([
            'title'             => 'required|string|max:255',
            'content'           => 'required|string',
            'send_to'           => 'required|string',
            'timer'             => 'required|in:1,2,3', // Ensure the timer is 1, 2, or 3 hours
            'specific-employee' => 'nullable|string',
        ]);

        $sendTo = $request->input('send_to');
        $timer = now()->addHours((int) $request->input('timer')); // Set expiration time

        if ($sendTo == 'specific') {
            $full_name = $request->input('specific-employee');

            // Search for employees by full name
            $employees = HR::where('full_name', 'like', '%' . $full_name . '%')
                ->select('emp_id', 'full_name') // Select relevant fields
                ->get();

            // Check if employees were found
            if ($employees->isEmpty()) {
                return redirect()->back()->withErrors([$full_name => 'Employee not found.']);
            }

            $employee = $employees->first();

            // Insert memo data into the database
            DB::table('memos')->insert([
                'title'             => $request->input('title'),
                'content'           => $request->input('content'),
                'send_to'           => $sendTo,
                'specific_employee' => $employee->emp_id, // Now you can access emp_id correctly
                'timer'             => $timer, // Store expiration time
                'created_at'        => now(),
                'updated_at'        => now(),
                'read'              => false,
            ]);
        } else {
            DB::table('memos')->insert([
                'title'             => $request->input('title'),
                'content'           => $request->input('content'),
                'send_to'           => $sendTo,
                'specific_employee' => null,
                'timer'             => $timer, // Store expiration time
                'created_at'        => now(),
                'updated_at'        => now(),
                'read'              => false,
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Memo sent successfully!');
    }



    public function searchEmployees(Request $request)
    {
        $full_name = $request->input('specific-employee');

        // Search for employees by full name
        $employees = HR::where('full_name', 'like', '%' . $full_name . '%')
            ->select('emp_id', 'full_name') // Select relevant fields
            ->get();

        // Check if employees were found
        if ($employees->isEmpty()) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        return response()->json($employees);
    }


    public function getMemos()
    {
        $memos = Memo::all();  // Get all memos (you can adjust this to filter or paginate as needed)
        return response()->json($memos);
    }


    // Method to handle memo replies (if applicable)
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        // Find the memo and update the reply
        $memo = Memo::find($id);
        if ($memo) {
            $memo->reply = $request->input('reply');
            $memo->save();
        }

        return redirect()->back()->with('success', 'Reply added successfully!');
    }

    public function getEmployeeMemos()
    {
        $empId = session('emp_id'); // Get logged-in employee's ID
        if (!$empId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $memos = Memo::where('send_to', 'all')
            ->orWhere('specific_employee', $empId)
            ->select('id', 'title', 'content', 'read')
            ->get()
            ->map(function ($memo) {
                // Ensure the 'read' field is either true or false
                $memo->read = $memo->read ?? false;
                return $memo;
            });

        return response()->json($memos);
    }


    public function replyMemo(Request $request, $id)
    {
        $memo = Memo::findOrFail($id);
        $memo->reply = $request->input('reply');
        $memo->save();

        return response()->json(['success' => true]);
    }


    public function markAsRead($id)
    {
        $memo = Memo::find($id);
        if ($memo) {
            $memo->read = true;
            $memo->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
