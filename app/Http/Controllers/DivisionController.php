<?php

namespace App\Http\Controllers;

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
}
