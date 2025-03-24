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
            $employee = DB::connection('mysql')->table('hr') // Assuming 'mysql' is the connection to your hr database
                ->where('full_name', 'like', '%' . $request->input('specific_employee') . '%')
                ->first();

            if ($employee) {
                // Send the memo to the specific employee
                // Add your logic here to send the memo
            } else {
                return redirect()->route('memo.form')->withErrors(['specific_employee' => 'Employee not found.']);
            }
        } elseif ($sendTo == 'heads') {
            // Send memo to heads only (retrieve heads from the hr database or another table)
            // Add your logic to send the memo to heads
        } else {
            // Send memo to all employees (retrieve all employees from the hr database)
            // Add your logic to send the memo to all employees
        }

        return redirect()->route('memo.form')->with('success', 'Memo sent successfully!');
    }

    public function searchEmployees(Request $request)
    {
        // Get the search term from the request
        $name = $request->input('full_name');

        // Query the 'hr' table for employees where the name matches the search term
        $employees = DB::table('hr') // Assuming 'hr' is the name of the table
            ->where('full_name', 'like', '%' . $name . '%') // Adjust the column name to match your database
            ->get();

        // Return the employees as a JSON response
        return response()->json($employees);
    }
}
