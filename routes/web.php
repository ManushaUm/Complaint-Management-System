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


//Guest Routes
Route::get('/', function () {
    return view('welcome');
});

//Auth Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/viewcomplaints', function () {
        return view('viewcomplaint');
    })->name('viewcomplaint');

    Route::get('/searchcomplaints', function () {
        return view('searchcomplaints');
    })->name('search.complaints');

    Route::get('/users', function () {
        return view('roleassignment');
    })->name('users');

    Route::get('/roles', function () {
        return view('useraccess');
    })->name('roles');

    Route::get('/employee', function () {
        return view('profile.information.employee');
    })->name('employee');

    //Member Job view return
    Route::get('/my-jobs', [complaintcontroller::class, 'myJobs'])->name('my-jobs');

    //add new department-page routes
    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index2'])->name('departments');
        Route::post('/store', [DepartmentController::class, 'store'])->name('departments.store');
        Route::post('/head', [DepartmentController::class, 'updateHead'])->name('departments.head');
    });

    //add divisions
    Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //complaint logging and viewing
    Route::get('/lodgenew', [NewComplaintController::class, 'lodgeNew'])->name('newcomplaint');
    Route::post('/viewcomplaints', [NewComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/viewcomplaint', [NewComplaintController::class, 'viewcomplaint'])->name('viewcomplaint');

    //complaints handling routes
    Route::get('/viewcomplaint/{id}', [ComplaintController::class, 'getComplaintDetails'])->name('viewcomplaintId');
    Route::post('/assign-job/{id}', [ComplaintController::class, 'assignJob'])->name('assign-job');
    Route::post('/add-comment/{id}', [ComplaintController::class, 'addComment'])->name('add-comment');

    //Profile handling routes
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


//test route >> can be removed when dev complete
Route::get('/test-employee', function () {
    return view('profile.information.test');
})->name('test-employee');


Route::get('/search', [Usercontroller::class, 'search'])->name('user.search');
Route::get('/api/roles', [UserController::class, 'getRoles']);
Route::get('/api/users', [UserController::class, 'getUsers']);
Route::put('/api/users/update-role', [UserController::class, 'updateUserRole']);

Route::get('/complaintdropdown', [complaintcontroller::class, 'typeview'])->name('complaintstatus.typeview');
Route::post('/complaintsave', [complaintcontroller::class, 'store'])->name('complaintstatus.store');

Route::put('/assign-complaint', [ComplaintController::class, 'assignComplaint'])->name('assign.complaint');

Route::get('/hr', [HRController::class, 'index']);
Route::get('/employee/search', [HRController::class, 'searchEmp'])->name('employee.search');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
