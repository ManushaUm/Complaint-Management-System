<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;

use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $division = new Division();
        $divisionsData = $division->getDivisions();
        //dd($divisionData);
        //return $divisionsData;
        return view('useraccess', compact('divisionsData'));
    }

    public function store(Request $request)
    {
        $deptDetails = $request->all();
        //dd($divDetails);
        $outerGroup = $deptDetails['outer-group'][0];
        //dd($outerGroup);
        $deptCode = $outerGroup['departmentSelect'];
        $deptDivDetails = $outerGroup['inner-group'];
        //dd($deptDivDetails);

        $departmentExists = Department::where('department_code', $deptCode)->exists();

        if (!$departmentExists) {
            return redirect()->back()->withErrors(['department_code' => 'The selected department code does not exist.']);
        }

        foreach ($deptDivDetails as $divDetail) {
            $division = new Division();
            $division->division_name = $divDetail['divisionName'];
            $division->department_code = $deptCode;
            $division->division_code = $divDetail['divisionCode'];
            $division->division_head = $divDetail['divisionHead'];
            //dd($division);
            $division->save();
        }
        return redirect()->route('users')->with('success', 'Divisions created successfully.');
    }
}
