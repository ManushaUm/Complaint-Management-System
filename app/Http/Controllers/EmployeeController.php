<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\NewComplaint;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Division;
class EmployeeController extends Controller
{
   
    public function profileDetails()
    {
        $user = Auth::user(); // Get the authenticated user
    
        // Fetch complaints assigned to the user's department from the new_complaints table
        $complaints = NewComplaint::where('department', $user->department)->get();
    
        $departmentNames = Department::all(); // Assuming you have a Department model
    
    
        $divisionNames = Division::all(); // Assuming you have a Division model
        
        return view('profile.information.employee', compact('user', 'complaints', 'departmentNames', 'divisionNames'));
    }
    


}
