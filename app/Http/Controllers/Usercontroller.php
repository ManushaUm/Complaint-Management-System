<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', '%' . $query . '%')
                     ->orWhere('email', 'LIKE', '%' . $query . '%')
                     ->select('name', 'email', 'role')
                     ->get();

        return response()->json($users);
    }

        public function getRoles()
    {
        $roles = Role::all(); // Assuming you have a Role model
        return response()->json($roles);
    }
/*
    public function getUsers()
{
    $users = User::select('id', 'name', 'email')->get();
    $formattedUsers = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'text' => "{$user->name} ({$user->email})"
        ];
    });

    return response()->json($formattedUsers);
}
/*
public function updateRole(Request $request, $id)
{  

    // 1. Retrieve the user by ID or fail if the user doesn't exist
    $user = User::findOrFail($id);

    // 2. Retrieve the 'role' from the request input
    $newRole = $request->input('role');

    // 3. Update the user's role
    $user->role = $newRole;
    $user->save();

    // 4. Return a success response
    return response()->json(['message' => 'Role updated successfully.']);
}
*/
public function updateUserRole(Request $request)
{
    //dd($request);
    // Validate the incoming request
    $request->validate([
        'email' => 'required|email|exists:users,email', 
        'role' => 'required|exists:roles,name', 
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Update the user's role
    $role = Role::where('name', $request->role)->first();
    if (!$role) {
        return response()->json(['error' => 'Role not found'], 404);
    }


    $user->role = $role->name;  // Store the role name in the 'role' field
    $user->save();

    return response()->json(['message' => 'User role updated successfully', 'user' => $user]);
}
}