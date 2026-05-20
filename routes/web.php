<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Login Route
Route::get('/', function () {
    return view('auth/login');
});

// Dashboard Module (Accessible by all verified authenticated users)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Departments Module (Admin, HR Staff, and Managers)
Route::middleware(['auth', 'role:admin,hr,manager'])->group(function () {
    Route::prefix('departments')->name('departments.')->group(function() {
        // Index
        Route::get('/', [DepartmentController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [DepartmentController::class, 'create'])->name('create');

        // Store
        Route::post('/', [DepartmentController::class, 'store'])->name('store');

        // Show
        Route::get('/{id}', [DepartmentController::class, 'show'])->name('show');

        // Edit
        Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('edit');

        // Update
        Route::patch('/{id}', [DepartmentController::class, 'update'])->name('update');

        // Destroy
        Route::delete('/{id}', [DepartmentController::class, 'destroy'])->name('destroy');
    });
});

// Employees Module (Admin and HR Staff only)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    Route::prefix('employees')->name('employees.')->group(function() {
        // Index
        Route::get('/', [EmployeeController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');

        // Store
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');

        // Show
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('show');

        // Edit
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');

        // Update
        Route::patch('/{id}', [EmployeeController::class, 'update'])->name('update');

        // Destroy
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });
});

// Attendances Module (Accessible by Admin, HR, Manager, and Employee)
Route::middleware(['auth', 'role:admin,hr,manager,employee'])->group(function(){
    Route::prefix('attendances')->name('attendances.')->group(function() {
        // Index
        Route::get('/', [AttendanceController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [AttendanceController::class, 'create'])->name('create');

        // Store
        Route::post('/store', [AttendanceController::class, 'store'])->name('store');

        // Show
        Route::get('/{id}', [AttendanceController::class, 'show'])->name('show');

        // Edit
        Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('edit');

        // Update
        Route::patch('/{id}', [AttendanceController::class, 'update'])->name('update');

        // Destroy
        Route::delete('/{id}', [AttendanceController::class, 'destroy'])->name('destroy');
    });
});

// Leave Requests Module (Accessible by Admin, HR, Manager, and Employee)
Route::middleware(['auth', 'role:admin,hr,manager,employee'])->group(function(){
    Route::prefix('leave-requests')->name('leave-requests.')->group(function () {
        // Index
        Route::get('/', [LeaveRequestController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [LeaveRequestController::class, 'create'])->name('create');

        // Store
        Route::post('/store', [LeaveRequestController::class, 'store'])->name('store');

        // Show
        Route::get('/{id}', [LeaveRequestController::class, 'show'])->name('show');

        // Edit
        Route::get('/{id}/edit', [LeaveRequestController::class, 'edit'])->name('edit');

        // Update
        Route::patch('/{id}', [LeaveRequestController::class, 'update'])->name('update');

        // Delete
        Route::delete('/{id}', [LeaveRequestController::class, 'destroy'])->name('destroy');

        // Updating STATUS
        Route::patch('/{id}/status', [LeaveRequestController::class, 'updateStatus'])->name('update-status');
    });
});

// Users Module (Admin and HR Staff only)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        // Index
        Route::get('/', [UserController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [UserController::class, 'create'])->name('create');

        // Store
        Route::post('/', [UserController::class, 'store'])->name('store');

        // Show
        Route::get('/{id}', [UserController::class, 'show'])->name('show');

        // Edit
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');

        // Update
        Route::put('/{id}', [UserController::class, 'update'])->name('update');

        // Destroy
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});

// Reports Module (Admin and HR)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    Route::prefix('reports')->name('reports.')->group(function () {
        
        Route::get('/', [ReportController::class, 'index'])->name('index');

        Route::get('/attendance', [ReportController::class, 'attendanceReport'])->name('attendance');
        Route::get('/leaves', [ReportController::class, 'leaveReport'])->name('leaves');
    });
});

// Profile Management (Accessible by any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Personal Portal
Route::middleware(['auth'])->group(function () {
    Route::get('/my-portal', [DashboardController::class, 'myPortal'])->name('dashboard.my-portal');
});

Route::get('/rescue', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    $output = "✅ <b>Caches successfully destroyed!</b><br><br>";

    $logPath = storage_path('logs/laravel.log');
    
    if (\Illuminate\Support\Facades\File::exists($logPath)) {
        $lines = array_slice(file($logPath), -50);
        $output .= "🚨 <b>Latest Error Logs:</b><br><br>";
        $output .= "<pre style='background:#111; color:#0f0; padding:20px; overflow-x:auto;'>" . implode("", $lines) . "</pre>";
    } else {
        $output .= "No log file exists yet! (The crash might be happening before Laravel even boots)";
    }

    return $output;
});

require __DIR__.'/auth.php';
