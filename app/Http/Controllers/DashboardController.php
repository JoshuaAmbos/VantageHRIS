<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dynamic role-based dashboard metrics interface.
     */
    public function index(): View
    {
        $user = Auth::user();

        // 1. SHARED METRICS: Values needed by all user tiers across the system
        $todayDate = Carbon::today()->toDateString();
        
        // Contextual Leave Request processing calculations
        if (in_array($user->role, ['admin', 'hr'])) {
            $totalRequests   = LeaveRequest::count();
            $pendingRequests = LeaveRequest::where('status', 'Pending')->count();
        } else {
            // Workers track their personal submissions only
            $totalRequests   = LeaveRequest::where('employee_id', $user->employee->id)->count();
            $pendingRequests = LeaveRequest::where('employee_id', $user->employee->id)
                ->where('status', 'Pending')
                ->count();
        }

        // 2. ADMIN & HR ROLE EXECUTION MATRIX
        if (in_array($user->role, ['admin', 'hr'])) {
            $totalEmployees        = Employee::count();
            $totalDepartments      = Department::count();
            $numActiveDepartments  = Department::where('status', 'active')->count();
            $totalUsers            = User::count();
            
            // Calculate monthly onboarded headcount metrics
            $numEmployeesMonth = Employee::whereMonth('hire_date', Carbon::now()->month)
                ->whereYear('hire_date', Carbon::now()->year)
                ->count();

            return view('dashboard', compact(
                'totalEmployees',
                'totalDepartments',
                'numActiveDepartments',
                'totalRequests',
                'pendingRequests',
                'totalUsers',
                'numEmployeesMonth'
            ));
        }

        // 3. EMPLOYEE & MANAGER ROLE EXECUTION MATRIX
        // Grab today's attendance log for the current employee
        $attendanceToday = Attendance::where('employee_id', $user->employee->id)
            ->where('attendance_date', $todayDate)
            ->first();

        $todayStatus = $attendanceToday ? str($attendanceToday->status)->title() : 'Not Clocked In';

        // Count total unique days present within the current calendar month
        $daysPresentCount = Attendance::where('employee_id', $user->employee->id)
            ->whereIn('status', ['present', 'late'])
            ->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year)
            ->count();

        // Standard statutory placeholder allowance mapping 
        $vacationBalance = 15; 

        return view('dashboard', compact(
            'todayStatus',
            'daysPresentCount',
            'totalRequests',
            'pendingRequests',
            'vacationBalance'
        ));
    }
}