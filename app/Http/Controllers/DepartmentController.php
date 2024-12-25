<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;



class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //dd('hello');
        $departments = Departments::all();
        //dd(compact('departments'));
        $id = $departments->pluck('id');
        $departmentNames = $departments->pluck('department_name');
        //dd($id);
        return view('useraccess', compact('departmentNames', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
