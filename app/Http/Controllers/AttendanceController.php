<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        if ($user->role === 'employee') {
            $attendances = Attendance::search($search)
                ->where('employee_id', $user->employee->id)
                ->paginate(8)
                ->withQueryString();
        } elseif ($user->role === 'manager') {
            $managerDeptId = $user->employee->department_id;
            $attendances = Attendance::search($search)
                ->whereHas('employee', function ($query) use ($managerDeptId) {
                    $query->where('department_id', $managerDeptId);
                })
                ->with('employee')
                ->paginate(8)
                ->withQueryString();
        } else {
            $attendances = Attendance::search($search)
                ->with('employee.department')
                ->latest()
                ->paginate(8)
                ->withQueryString();
        }

        return view('attendances.index', compact('attendances', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $statuses = Attendance::getEnumValues('status');
        
        return view('attendances.create', compact('employees', 'statuses'));
    }

    /**
     * Store a newly created resource in storage (Administrative Override).
     */
    public function store(AttendanceRequest $request)
    {
        Attendance::create($request->validated());
        
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('employee.department')->findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        $statuses = Attendance::getEnumValues('status');
        
        return view('attendances.edit', compact('attendance', 'employees', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->validated());

        return redirect()->route('attendances.index')->with('success', 'Attendance record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance record deleted successfully!');
    }

    /**
     * Self-Service: Record a user's initial time-in stamp for the current day.
     */
    public function timeIn(Request $request)
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return redirect()->back()->with('error', 'No employee profile linked to this user account.');
        }

        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        // Prevent duplicate punch-ins for the same calendar date
        $existingRecord = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'You have already clocked in for today.');
        }

        // Auto-determine punch quality status parameters against an 08:00 AM baseline
        $cutoffTime = Carbon::today()->setHour(8)->setMinute(0)->setSecond(0);
        $status = $now->greaterThan($cutoffTime) ? 'late' : 'present';

        Attendance::create([
            'employee_id'     => $employee->id,
            'attendance_date' => $today,
            'time_in'         => $now->toTimeString(),
            'time_out'        => '00:00:00',
            'status'          => $status,
            'remarks'         => $status === 'late' ? 'System tagged: Clock-in recorded after 08:00 AM shift baseline.' : null,
        ]);

        return redirect()->back()->with('success', 'Clock-in recorded successfully!');
    }

    /**
     * Self-Service: Record a user's concluding time-out stamp for the current day.
     */
    public function timeOut(Request $request)
    {
        $employee = auth()->user()->employee;
        if (!$employee) {
            return redirect()->back()->with('error', 'No employee profile linked to this user account.');
        }

        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        // Locate the matching time-in record that needs closure
        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('attendance_date', $today)
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'No clock-in record found for today. Please clock in first.');
        }

        if ($attendance->time_out !== '00:00:00') {
            return redirect()->back()->with('error', 'You have already clocked out for today.');
        }

        $attendance->update([
            'time_out' => $now->toTimeString(),
        ]);

        return redirect()->back()->with('success', 'Clock-out recorded successfully!');
    }
}