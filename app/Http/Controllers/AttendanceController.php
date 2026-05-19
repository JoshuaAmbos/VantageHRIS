<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'employee') {
            $attendances = Attendance::where('employee_id', $user->employee->id)->get();
        } elseif ($user->role === 'manager') {
            $managerDeptId = $user->employee->department_id;
            $attendances = Attendance::whereHas('employee', function ($query) use ($managerDeptId) {
                $query->where('department_id', $managerDeptId);
            })->with('employee')->get();
        } else {

            // Admin & HR see global attendance 
            $attendances = Attendance::with('employee.department')->get();
        }

        return view('attendances.index', compact('attendances'));
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
     * Store a newly created resource in storage.
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
        //
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
}
