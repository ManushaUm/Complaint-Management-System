<?php

namespace App\Http\Controllers;

use App\Models\ComplaintLog;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\NewComplaint;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Division;
use App\Models\HR;

class EmployeeController extends Controller
{

    public function profileDetails($emp_id)
    {
        // Fetch the user based on the emp_id from the route
        $user = HR::where('emp_id', $emp_id)->firstOrFail();

        // Fetch complaints assigned to the user's department from the new_complaints table
        $getAllLogs = new NewComplaint();
        $complaints = $getAllLogs->getAllLogs()->where('Assigned_to', $user->emp_id);
        //$complaints = ComplaintLog::where('department', $user->department)->get();

        // Fetch all department names
        $departmentNames = Department::all();

        // Fetch all division names
        $divisionNames = Division::all();

        // Render the relevant content to the blade view
        return view('profile.information.employee', compact('user', 'complaints', 'departmentNames', 'divisionNames'));
    }
}
