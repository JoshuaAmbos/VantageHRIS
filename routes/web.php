<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

// Login
Route::get('/', function () {
    return view('auth/login');
});

// Dashboard Module
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Departments Module (Admin, HR)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
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

// Employees Module (Admin, HR)
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

// TODO : VERIFY RBAC
// Attendances Module (HR, Manager, Employee)
Route::middleware(['auth', 'role:admin,hr'])->group(function(){
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

// Leave Requests Module (Admin, HR, Manager, Employee)
Route::middleware(['auth', 'role:admin,hr'])->group(function(){
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
    });
});

// Users Module (Admin)
Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    
    Route::prefix('users')->name('users.')->group(function () {
        
        // Index
        Route::get('/', [UserController::class, 'index'])->name('index');

        // Create
        Route::get('/create', [UserController::class, 'create'])->name('create');

        // Store
        Route::post('/', [UserController::class, 'store'])->name('store');

        // Show
        Route::get('/{user}', [UserController::class, 'show'])->name('show');

        // Edit
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');

        // Update
        Route::put('/{user}', [UserController::class, 'update'])->name('update');

        // Destroy
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        
    });
});



// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';