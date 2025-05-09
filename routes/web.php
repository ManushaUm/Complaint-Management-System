<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\complaintcontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;

//Guest Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

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

    //get division data
    Route::get('/get-divisions/{department_id}', [DivisionController::class, 'getDivisions'])->name('getDivisions');

    //Member Job view 
    Route::get('/my-jobs', [complaintcontroller::class, 'myJobs'])->name('my-jobs');
    //Closed jobs view for Heads
    Route::get('/closed-jobs', [complaintcontroller::class, 'closedJobs'])->name('closed-jobs');
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

    Route::get('/completed-jobs', [NewComplaintController::class, 'completedJobs'])->name('completedJobs');

    //Profile handling routes
    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //complaint closing by head
    Route::put('/close-complaint/{id}', [complaintcontroller::class, 'closeComplaint'])->name('closeComplaint');
    //complaint Reopening by head
    Route::put('/log-complaint/{id}', [complaintcontroller::class, 'reopenComplaint'])->name('logcomplaint');
    //complaint rejection by head
    Route::put('/reject-complaint/{id}', [complaintcontroller::class, 'rejectComplaint'])->name('rejectComplaint');

    Route::get('/employee/{id}', [EmployeeController::class, 'profileDetails'])->name('user');

    //Report routes
    Route::get('/reports/view', [ReportController::class, 'index'])->name('reports.view');
    Route::post('/reports/create', [ReportController::class, 'generateReport'])->name('reports.create');
    Route::get('/reports/complaints', [ReportController::class, 'complaints'])->name('reports.complaints');
    Route::get('/reports/summary', [ReportController::class, 'summary'])->name('reports.summary');
    //Route::get('/reports/download-pdf', [ReportController::class, 'downloadPDF'])->name('downloadPDF');
    //Route::get('/reports/download-excel', [ReportController::class, 'downloadExcel'])->name('downloadExcel');
    //Route::get('/reports/download-pdf-complaint', [ReportController::class, 'downloadPDFComplaint'])->name('downloadPDFComplaint');
    //Route::get('/reports/download-excel-complaint', [ReportController::class, 'downloadExcelComplaint'])->name('downloadExcelComplaint');
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
