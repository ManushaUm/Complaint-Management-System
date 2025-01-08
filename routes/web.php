<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use App\Http\Controllers\TableViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;
use App\Http\Controllers\Usercontroller;

Route::get('/search', [Usercontroller::class, 'search'])->name('user.search');
Route::get('/api/roles', [UserController::class, 'getRoles']);
Route::get('/api/users', [UserController::class, 'getUsers']); 
//Route::put('api/users/{id}/role', [UserController::class, 'updateRole']);
//Route::put('/api/users/{userId}/role', [UserController::class, 'updateUserRole']);
//Route::put('/api/users/update-role/{userId}', [UserController::class, 'updateRole']);
Route::put('/api/users/update-role', [UserController::class, 'updateUserRole']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/complaints', [NewComplaintController::class, 'store'])->name('complaints.store');
Route::post('/verify-user', [NewComplaintController::class, 'verifyUser'])->name('verify.user');
Route::get('/lodgenew', [NewComplaintController::class, 'lodgeNew'])->name('newcomplaint');

Route::post('/viewcomplaints', [NewComplaintController::class, 'store'])->name('complaints.store');
Route::get('/searchcomplaint', [NewComplaintController::class, 'searchForm'])
    ->middleware(['auth', 'verified'])
    ->name('search.complaints.form');

Route::post('/searchcomplaint', [NewComplaintController::class, 'search'])
    ->middleware(['auth', 'verified'])
    ->name('search.complaints');

Route::get('/showComplaint/{policy_number}', [NewComplaintController::class, 'show'])->name('complaints.show');

Route::get('/viewcomplaints', function () {
    return view('viewcomplaint');
})->middleware(['auth', 'verified'])->name('viewcomplaint');



Route::get('/viewcomplaint', [NewComplaintController::class, 'viewcomplaint'])->name('viewcomplaint');

Route::get('/searchcomplaints', function () {
    return view('searchcomplaints');
})->middleware(['auth', 'verified'])->name('searchcomplaints');

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

Route::get('/complaintdropdown', [complaintcontroller::class, 'typeview'])->name('complaintstatus.typeview');

Route::post('/complaintsave', [complaintcontroller::class, 'store'])->name('complaintstatus.store');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
