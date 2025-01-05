<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Support\Facades\DB;

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

    public function index2()
    {
        //$division = new Division();
        //$divisionsData = $division->getDivisions();
        $divisionsData = Division::select(
            'divisions_table.division_name',
            'divisions_table.division_code',
            'divisions_table.department_code',
            'divisions_table.division_head',
            'hr_div_head.full_name as div_head_name'

        )->leftJoin('hr as hr_div_head', 'divisions_table.division_head', '=', 'hr_div_head.emp_id')
            ->get();

        $departments = Department::select(
            'departments.id',
            'departments.department_name',
            'departments.department_code',
            'hr_head.full_name as department_head_name',
            'hr_alt_head.full_name as department_alter_head_name'
        )
            ->leftJoin('hr as hr_head', 'departments.department_head', '=', 'hr_head.emp_id')
            ->leftJoin('hr as hr_alt_head', 'departments.department_alter_head', '=', 'hr_alt_head.emp_id')
            ->get();



        return view('useraccess', compact('departments', 'divisionsData'));
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

    public function updateHead(Request $request)
    {
        $deptHeadDetail = $request->all();
        //dd($request->all());
        $deptCode = $deptHeadDetail['departmentSelect'];
        $deptPos = $deptHeadDetail['positionSelect'];
        $empDetail = $deptHeadDetail['empDetail'];

        //check the department exists

        $department = DB::table('departments')->where('department_code', $deptCode)->first();

        if (!$department) {
            return back()->withErrors(['error' => 'Department not found ']);
        } else if ($deptPos == 'deptHead') {
            //logic to update relevent dept Head
            //dd('department head called successfully');
            DB::table('departments')->where('department_code', $deptCode)->update(['department_head' => $empDetail]); //use toast to notify user here

            return back()->with('success', 'department head updated successfully');
        } else if ($deptPos == 'deptAltHead') {
            //logic to update relevent dept alt Head
            //dd('department alt head called successfully');
            DB::table('departments')->where('department_code', $deptCode)->update(['department_alter_head' => $empDetail]);

            return back()->with('success', 'department alternate head updated successfully'); //use toast to notify user here
        }

        //return redirect()->route('users');
    }
}
