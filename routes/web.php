<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HRController;

//auth routes
Route::get('/users', [DepartmentController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
//add new department route
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//view routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/viewcomplaints', function () {
    return view('viewcomplaint');
})->middleware(['auth', 'verified'])->name('viewcomplaint');

Route::get('/searchcomplaints', function () {
    return view('searchcomplaints');
})->middleware(['auth', 'verified'])->name('searchcomplaints');

Route::get('/complaint', function () {
    return view('complaint');
})->middleware(['auth', 'verified'])->name('complaint');



Route::get('/lodgenew', [NewComplaintController::class, 'lodgeNew'])->name('newcomplaint');
//Viewc complaints
Route::post('/viewcomplaints', [NewComplaintController::class, 'store'])->name('complaints.store');
Route::get('/viewcomplaint', [NewComplaintController::class, 'viewcomplaint'])->name('viewcomplaint');
//Route::get('/users', [NewComplaintController::class, 'viewcomplaint'])->name('users');
Route::get('/complaintdropdown', [complaintcontroller::class, 'typeview'])->name('complaintstatus.typeview');
Route::post('/complaintsave', [complaintcontroller::class, 'store'])->name('complaintstatus.store');

Route::post('/assign-complaint', [ComplaintController::class, 'assignComplaint'])->name('assign.complaint');

Route::get('/hr', [HRController::class, 'index']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
