<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\HrActivity;
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
        $recentActivities = HrActivity::with('user')->latest()->take(5)->get();

        $todayDate = Carbon::today()->toDateString();
        
        if (in_array($user->role, ['admin', 'hr'])) {
            $totalRequests   = LeaveRequest::count();
            $pendingRequests = LeaveRequest::where('status', 'Pending')->count();
        } else {
            $totalRequests   = LeaveRequest::where('employee_id', $user->employee->id)->count();
            $pendingRequests = LeaveRequest::where('employee_id', $user->employee->id)
                ->where('status', 'Pending')
                ->count();
        }

        if (in_array($user->role, ['admin', 'hr'])) {
            $totalEmployees        = Employee::count();
            $totalDepartments      = Department::count();
            $numActiveDepartments  = Department::where('status', 'active')->count();
            $totalUsers            = User::count();
            
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
                'numEmployeesMonth',
                'recentActivities'
            ));
        }

        $attendanceToday = Attendance::where('employee_id', $user->employee->id)
            ->where('attendance_date', $todayDate)
            ->first();

        $todayStatus = $attendanceToday ? str($attendanceToday->status)->title() : 'Not Clocked In';

        $daysPresentCount = Attendance::where('employee_id', $user->employee->id)
            ->whereIn('status', ['present', 'late'])
            ->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year)
            ->count();

        $vacationBalance = 15; 

        return view('dashboard', compact(
            'todayStatus',
            'daysPresentCount',
            'totalRequests',
            'pendingRequests',
            'vacationBalance',
            'recentActivities'
        ));
    }
}