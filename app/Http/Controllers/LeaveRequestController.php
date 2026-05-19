<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequestRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequests = LeaveRequest::orderByDesc('created_at')->get();
        $employees = Employee::all();
        $message = "No leave requests found.";

        return view('leave-requests.index', compact('leaveRequests', 'employees', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveRequests = LeaveRequest::all();
        $types = LeaveRequest::getEnumValues('leave_type');
        

        return view('leave-requests.create', compact('leaveRequests', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequestRequest $request)
    {
        // Validate    
        $validated = $request->validated();

        // Fetch logged-in user, resolve their employee profile, and grab the primary id
        $employeeId = Auth::user()->employee->id;
        // Inject backend variables
        $validated['employee_id'] = $employeeId;
        $validated['status'] = LeaveRequest::STATUS_PENDING;
        $validated['approved_by'] = NULL;

        // Create leave request
        LeaveRequest::create($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request submitted successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = LeaveRequest::findOrFail($id);

        return view('leave-requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $request = LeaveRequest::findOrFail($id);
        $types = LeaveRequest::getEnumValues('leave_type');

        return view('leave-requests.edit', compact('request', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequestRequest $request, string $id)
    {
        $request = LeaveRequest::findOrFail($id);
        
        $validated = $request->validated();

        // Fetch logged-in user, resolve their employee profile, and grab the primary id
        $employeeId = Auth::user()->employee->id;

        // Inject backend variables
        $validated['employee_id'] = $employeeId;
        $validated['status'] = LeaveRequest::STATUS_PENDING;
        $validated['approved_by'] = NULL;

        $request->update($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = LeaveRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully!');
    }
}
