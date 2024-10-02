<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD

Route::get('/lodgenew', [NewComplaintController::class, 'lodgeNew'])->name('newcomplaint');

Route::post('/complaints', [NewComplaintController::class, 'store'])->name('complaints.store');

//Route::get('/viewcomplaints')->name('viewcomplaint');

Route::get('/viewcomplaints', function () {
    return view('viewcomplaint');
})->middleware(['auth', 'verified'])->name('viewcomplaint');

Route::get('/searchcomplaints', function () {
    return view('searchcomplaints');
})->middleware(['auth', 'verified'])->name('searchcomplaints');

Route::get('/users', function () {
    return view('useraccess');
})->middleware(['auth', 'verified'])->name('users');


=======
<<<<<<< Updated upstream
=======
Route::get('/lodgenew', function () {
    return view('newcomplaint');
})->middleware(['auth', 'verified'])->name('newcomplaint');

Route::get('/complaint', function () {
    return view('complaint');
})->middleware(['auth', 'verified'])->name('complaint');

Route::post('/complaintsave', [complaintcontroller::class , 'store'])->name('complaintstatus.store');


>>>>>>> Stashed changes
>>>>>>> 75fea66 (Update web.php)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
