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
