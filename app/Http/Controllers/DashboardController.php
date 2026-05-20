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
        
        // Ensure the logged-in user has an employee profile
        $employeeProfile = $user->employee;

        // ADMIN & HR GLOBAL ACCESS LEVEL
        if (in_array($user->role, ['admin', 'hr'])) {
            $totalRequests = LeaveRequest::count();
            $pendingRequests = LeaveRequest::where('status', 'Pending')->count();
            $totalEmployees = Employee::count();
            $totalDepartments = Department::count();
            $numActiveDepartments = Department::where('status', 'active')->count();
            $totalUsers = User::count();
            
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

        //  DEPARTMENT MANAGER SUPERVISORY LEVEL
        if ($user->role === 'manager' && $employeeProfile) {
            $myDepartmentId = $employeeProfile->department_id;

            // Gather metrics restricted strictly to their assigned team division
            $totalEmployees = Employee::where('department_id', $myDepartmentId)->count();
            $totalRequests = LeaveRequest::whereHas('submittedBy', function ($q) use ($myDepartmentId) {
                $q->where('department_id', $myDepartmentId); 
                })->count();
            $pendingRequests   = LeaveRequest::where('status', 'Pending')->whereHas('submittedBy', function ($q) use ($myDepartmentId) {
                $q->where('department_id', $myDepartmentId);
                })->count();

            // Self clock-in tracking metrics
            $attendanceToday = Attendance::where('employee_id', $employeeProfile->id)
                ->where('attendance_date', $todayDate)
                ->first();
            $todayStatus = $attendanceToday ? str($attendanceToday->status)->title() : 'Not Clocked In';

            return view('dashboard', compact(
                'totalEmployees',
                'totalRequests',
                'pendingRequests',
                'todayStatus',
                'recentActivities'
            ));
        }

        //  STANDARD EMPLOYEE PORTAL LEVEL
        $totalRequests = $employeeProfile ? LeaveRequest::where('employee_id', $employeeProfile->id)->count() : 0;
        $pendingRequests = $employeeProfile ? LeaveRequest::where('employee_id', $employeeProfile->id)->where('status', 'Pending')->count() : 0;
        
        $attendanceToday = $employeeProfile ? Attendance::where('employee_id', $employeeProfile->id)->where('attendance_date', $todayDate)->first() : null;
        $todayStatus = $attendanceToday ? str($attendanceToday->status)->title() : 'Not Clocked In';

        $daysPresentCount = $employeeProfile ? Attendance::where('employee_id', $employeeProfile->id)
            ->whereIn('status', ['present', 'late'])
            ->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year)
            ->count() : 0;

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

    public function myPortal()
    {
        $employee = auth()->user()->employee;
        
        if (!$employee) {
            abort(404, 'No employee profile linked to this user account.');
        }

        // Pull recent personal historical data stacks
        $recentAttendance = $employee->attendanceRecords()->latest()->take(5)->get();
        $leaveRequests = $employee->leaveRequestsSubmitted()->latest()->get();

        return view('dashboard.my-portal', compact('employee', 'recentAttendance', 'leaveRequests'));
    }
}