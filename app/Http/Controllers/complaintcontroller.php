<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\complaintstatus;

class complaintcontroller extends Controller
{
    public function store(Request $request)
    {
        dd($request->input());
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'location' => 'required',
            'branch' => 'required',
            'resperson' => 'required',
            'altperson' => 'required',
            'pred' => 'required',
            'description' => 'required',
        ]);

        $complaint = new complaintstatus();
        $complaint->category = $request->category;
        $complaint->subcategory = $request->subcategory;
        $complaint->location = $request->location;
        $complaint->branch = $request->branch;
        $complaint->resperson = $request->resperson;
        $complaint->altperson = $request->altperson;
        $complaint->pred = $request->pred;
        $complaint->description = $request->description;
        $complaint->save();

        return redirect()->route('complaint')
            ->with('success', 'Complaint created successfully.');
    }
    
}
