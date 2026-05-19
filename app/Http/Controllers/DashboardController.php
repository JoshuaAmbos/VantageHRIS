<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Employee;

class DashboardController extends Controller
{
    public function index() {
        // Employees
        $totalEmployees = Employee::count();
        $numEmployeesMonth = Employee::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();

        // Departments
        $totalDepartments = Department::count();
        $numActiveDepartments = Department::where('status', 'active')->count();

        // Leave Requests
        $totalRequests = LeaveRequest::count();
        $pendingRequests = LeaveRequest::where('status', LeaveRequest::STATUS_PENDING)->count();

        // Attendances
        //

        // Users
        $totalUsers = User::count();
        
        return view('dashboard', compact(
            'totalEmployees',
            'numEmployeesMonth',
            'totalDepartments',
            'numActiveDepartments',
            'totalRequests',
            'pendingRequests',
            'totalUsers',
            
            ));
    }
}
