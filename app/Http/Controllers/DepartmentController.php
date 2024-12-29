<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;



class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //dd('hello');
        $departments = Department::all();
        //dd(compact('departments'));
        $id = $departments->pluck('id');
        $departmentNames = $departments->pluck('department_name');
        //dd($id);
        return view('useraccess', compact('departmentNames', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $dept = $request->all();
        // $request->validate([
        //     'department_name' => 'required|string|max:255',
        //  ]);
        // Access nested data
        $outerGroup = $dept['outer-group'][0];
        $deptName = $outerGroup['deptName'];
        $deptCode = $outerGroup['deptCode'];
        $deptHead = $outerGroup['deptHead'];
        $deptAltHead = $outerGroup['deptAltHead'];


        $department = new Department();
        $department->department_name = $deptName;
        $department->department_code = $deptCode;
        $department->department_head = $deptHead;
        $department->department_alter_head = $deptAltHead;

        $department->save();

        //dd($department);



        return redirect()->route('users')->with('success', 'Department created successfully.');
    }
}
