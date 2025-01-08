<?php

namespace App\Http\Controllers;

use App\Models\HR;
use Illuminate\Http\Request;

class HRController extends Controller
{
    //
    public function index()
    {
        $hrData = HR::all();
        dd($hrData);
    }

    public function searchEmployee(Request $request)
    {
        dd($request->all());
        $data = $request->all();
        //find id empDetail from HR model
        $employeeId = $data['empDetail'];


        $employee = HR::where('Emp_Id', $employeeId)->first();
        //dd($employee->email);
        if ($employee) {
            //return response()->json($employee);
            return redirect()->route('users')->with(['success' => 'User found', 'employee' => $employee]);
            //return view('useraccess', compact('employee'));
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    public function searchEmp(Request $request)
    {
        $empDetail = $request->input('empDetail');
        //dd($empDetail);
        $employee = HR::where('emp_Id', $empDetail)->first();
        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }
}
