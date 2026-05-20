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
        $pendingLeaves = LeaveRequest::where('status', LeaveRequest::STATUS_PENDING ?? 'Pending')->count();

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
            Attendance::STATUS_PRESENT  => 0,
            Attendance::STATUS_LATE     => 0,
            Attendance::STATUS_ON_LEAVE => 0,
            Attendance::STATUS_ABSENT   => 0,
        ];

        $attendances = Attendance::with('employee')->whereDate('attendance_date', $date)->paginate(6);

        foreach ($attendances as $attendance) {
            $statusKey = strtolower(trim($attendance->status));
            if (array_key_exists($statusKey, $attendanceSummary)) {
                $attendanceSummary[$statusKey]++;
            }
        }

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

        $typeDistribution = LeaveRequest::select('leave_type', DB::raw('count(*) as total'))
            ->groupBy('leave_type')
            ->get();

        return view('reports.leaves', compact('leaveSummary', 'typeDistribution'));
    }
}
