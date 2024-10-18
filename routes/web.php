<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use App\Http\Controllers\TableViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/lodgenew', [NewComplaintController::class, 'lodgeNew'])->name('newcomplaint');

Route::post('/viewcomplaints', [NewComplaintController::class, 'store'])->name('complaints.store');



Route::get('/viewcomplaints', function () {
    return view('viewcomplaint');
})->middleware(['auth', 'verified'])->name('viewcomplaint');

Route::get('/viewcomplaint', [NewComplaintController::class, 'viewcomplaint'])->name('viewcomplaint');


Route::get('/searchcomplaints', function () {
    return view('searchcomplaints');
})->middleware(['auth', 'verified'])->name('searchcomplaints');

Route::get('/users', function () {
    return view('useraccess');
})->middleware(['auth', 'verified'])->name('users');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/complaint', function () {
    return view('complaint');
})->middleware(['auth', 'verified'])->name('complaint');

//Route::get('/complaintdropdown', [complaintcontroller::class , 'typeview'])->name('complaintstatus.typeview');

Route::post('/complaintsave', [complaintcontroller::class , 'store'])->name('complaintstatus.store');


require __DIR__ . '/auth.php';
