<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|string|max:255',
            'content'           => 'required|string',
            'send_to'           => 'required|string',
            'specific_employee' => 'nullable|string', // Search term for specific employee
        ]);

        $sendTo = $request->input('send_to');

        if ($sendTo == 'specific' && $request->filled('specific_employee')) {
            // Search for a specific employee based on the name from the 'hr' table
            $employee = DB::connection('mysql')->table('hr')
                ->where('full_name', 'like', '%' . $request->input('specific_employee') . '%')
                ->first();

            if ($employee) {
                // Saved the memo in the table
                DB::table('memos')->insert([
                    'title'       => $request->input('title'),
                    'content'     => $request->input('content'),
                    'send_to'     => $sendTo,
                    'specific_employee' => $employee->Emp_Id,
                ]);
            } else {
                return redirect()->route('memo.form')->withErrors(['specific_employee' => 'Employee not found.']);
            }
        } elseif ($sendTo == 'heads') {
            // Save the memo in the table. send_to field is heads
            DB::table('memos')->insert([
                'title'       => $request->input('title'),
                'content'     => $request->input('content'),
                'send_to'     => $sendTo,
                'specific_employee' => "null"
            ]);
        } else {
            // Save the memo in the table. send_to field is all
            DB::table('memos')->insert([
                'title'       => $request->input('title'),
                'content'     => $request->input('content'),
                'send_to'     => $sendTo,
                'specific_employee' => "null"
            ]);
        }

        return redirect()->route('memo.form')->with('success', 'Memo sent successfully!');
    }

    public function searchEmployees(Request $request)
    {
        // Get the search term from the request
        $name = $request->input('full_name');

        // Query the 'hr' table for employees where the name matches the search term
        $employees = DB::table('hr')
            ->where('full_name', 'like', '%' . $name . '%')
            ->get();

        // Return the employees as a JSON response
        return response()->json($employees);
    }
}
