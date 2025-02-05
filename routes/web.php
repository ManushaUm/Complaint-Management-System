<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\Usercontroller;

//auth routes
Route::get('/departments', [DepartmentController::class, 'index2'])->middleware(['auth', 'verified'])->name('departments');
//Route::get('/users', [DivisionController::class, 'index']);

//add new department route
Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
Route::post('/departments/head', [DepartmentController::class, 'updateHead'])->name('departments.head');

Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/search', [Usercontroller::class, 'search'])->name('user.search');
Route::get('/api/roles', [UserController::class, 'getRoles']);
Route::get('/api/users', [UserController::class, 'getUsers']);
Route::put('/api/users/update-role', [UserController::class, 'updateUserRole']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/viewcomplaints', function () {
    return view('viewcomplaint');
})->middleware(['auth', 'verified'])->name('viewcomplaint');

Route::get('/searchcomplaints', function () {
    return view('searchcomplaints');
})->middleware(['auth', 'verified'])->name('search.complaints');


Route::get('/users', function () {
    return view('roleassignment');
})->middleware(['auth', 'verified'])->name('users');

Route::get('/roles', function () {
    return view('useraccess');
})->middleware(['auth', 'verified'])->name('roles');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

Route::put('/assign-complaint', [ComplaintController::class, 'assignComplaint'])->name('assign.complaint');

Route::get('/hr', [HRController::class, 'index']);
Route::get('/employee/search', [HRController::class, 'searchEmp'])->name('employee.search');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
