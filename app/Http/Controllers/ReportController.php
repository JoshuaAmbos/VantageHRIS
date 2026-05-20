<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the main reporting landing dashboard overview.
     */
    public function index()
    {
        $totalEmployees = Employee::count();
        $pendingLeaves = LeaveRequest::where('status', 'Pending')->count();

        $positionDistribution = Employee::select('position', DB::raw('count(*) as total'))
            ->groupBy('position')
            ->get();

        return view('reports.index', compact('totalEmployees', 'pendingLeaves', 'positionDistribution'));
    }

    /**
     * Generate an analytical overview of daily attendance trends.
     */
    public function attendanceReport(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $attendanceSummary = [
            'present'  => 0,
            'late'     => 0,
            'on leave' => 0,
            'absent'   => 0,
        ];

        // Fetch total aggregates across all records for the target day
        $globalDayRecords = Attendance::whereDate('attendance_date', $date)->get();

        foreach ($globalDayRecords as $attendance) {
            $statusKey = strtolower(trim($attendance->status));
            if (array_key_exists($statusKey, $attendanceSummary)) {
                $attendanceSummary[$statusKey]++;
            }
        }

        // Fetch a separate, paginated subset strictly for the list view UI component
        $attendances = Attendance::with('employee.department')
            ->whereDate('attendance_date', $date)
            ->paginate(15) // Expanded to 15 for better analytical scanning
            ->withQueryString();

        return view('reports.attendance', compact('attendanceSummary', 'attendances', 'date'));
    }

    /**
     * Generate an analytical overview of leave request distributions.
     */
    public function leaveReport()
    {
        $leaveSummary = LeaveRequest::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Ensure missing statuses default to 0 so views don't encounter undefined offset notices
        $statuses = ['Pending', 'Approved', 'Rejected'];
        foreach ($statuses as $status) {
            if (!isset($leaveSummary[$status])) {
                $leaveSummary[$status] = 0;
            }
        }

        $typeDistribution = LeaveRequest::select('leave_type', DB::raw('count(*) as total'))
            ->groupBy('leave_type')
            ->get();

        return view('reports.leaves', compact('leaveSummary', 'typeDistribution'));
    }
}