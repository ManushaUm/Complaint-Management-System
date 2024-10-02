<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
