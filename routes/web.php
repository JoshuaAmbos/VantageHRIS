<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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


// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
