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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        if ($user->role === 'employee') {
            $leaveRequests = LeaveRequest::search($search)
                ->where('employee_id', $user->employee->id)
                ->paginate(7)
                ->withQueryString();
        } elseif ($user->role === 'manager') {
            $managerDeptId = $user->employee->department_id;
            $leaveRequests = LeaveRequest::search($search)
                ->whereHas('submittedBy', function ($query) use ($managerDeptId) {
                    $query->where('department_id', $managerDeptId);
                })
                ->with('submittedBy')
                ->paginate(7)
                ->withQueryString();
        } else {
            $leaveRequests = LeaveRequest::search($search)
                ->with('submittedBy')
                ->paginate(7)
                ->withQueryString();
        }

        return view('leave-requests.index', compact('leaveRequests', 'search'));
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
        $validated = $request->validated();
        $user = auth()->user();

        // FIXED: Explicitly secure input data ownership properties
        $validated['employee_id'] = $user->employee->id;
        $validated['status'] = LeaveRequest::STATUS_PENDING;
        $validated['approved_by'] = NULL;

        LeaveRequest::create($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $leaveRequest = LeaveRequest::with(['submittedBy', 'approvedBy'])->findOrFail($id);

        // FIXED: Verify profile access alignment bounds for employees and managers
        if ($user->role === 'employee' && $leaveRequest->employee_id !== $user->employee->id) {
            abort(403, 'Unauthorized access request.');
        }

        if ($user->role === 'manager' && ($leaveRequest->submittedBy->department_id ?? null) !== $user->employee->department_id) {
            abort(403, 'Unauthorized access request.');
        }

        return view('leave-requests.show', compact('leaveRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $request = LeaveRequest::findOrFail($id);
        
        // FIXED: Enforce ownership checks before opening edit view layout
        if ($user->role === 'employee' && $request->employee_id !== $user->employee->id) {
            abort(403, 'Unauthorized modification request.');
        }

        if ($user->role === 'manager' && ($request->submittedBy->department_id ?? null) !== $user->employee->department_id) {
            abort(403, 'Unauthorized modification request.');
        }

        if ($request->status !== LeaveRequest::STATUS_PENDING) {
            return redirect()->route('leave-requests.index')->with('error', 'Cannot edit a finalized leave request.');
        }

        $types = LeaveRequest::getEnumValues('leave_type');

        return view('leave-requests.edit', compact('request', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequestRequest $request, string $id)
    {
        $user = auth()->user();
        $leaveRequest = LeaveRequest::with('submittedBy')->findOrFail($id);
        
        // FIXED: Enforce mutation layer isolation boundaries
        if ($user->role === 'employee' && $leaveRequest->employee_id !== $user->employee->id) {
            abort(403, 'Unauthorized modification request.');
        }

        if ($user->role === 'manager' && ($leaveRequest->submittedBy->department_id ?? null) !== $user->employee->department_id) {
            abort(403, 'Unauthorized modification request.');
        }

        if ($leaveRequest->status !== LeaveRequest::STATUS_PENDING) {
            return redirect()->route('leave-requests.index')->with('error', 'Cannot update a finalized leave request.');
        }

        $validated = $request->validated();
        
        // FIXED: Maintain original record ownership assignments during updates
        if ($user->role === 'employee') {
            $validated['employee_id'] = $user->employee->id;
        }

        $validated['status'] = LeaveRequest::STATUS_PENDING;
        $validated['approved_by'] = NULL;

        $leaveRequest->update($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $request = LeaveRequest::with('submittedBy')->findOrFail($id);
        
        // FIXED: Secure deletion access layers across all roles
        if ($user->role === 'employee' && $request->employee_id !== $user->employee->id) {
            abort(403, 'Unauthorized deletion request.');
        }

        if ($user->role === 'manager' && ($request->submittedBy->department_id ?? null) !== $user->employee->department_id) {
            abort(403, 'Unauthorized deletion request.');
        }

        if ($user->role === 'employee' && $request->status !== LeaveRequest::STATUS_PENDING) {
            return redirect()->route('leave-requests.index')->with('error', 'Cannot delete a processed leave request.');
        }

        $request->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully!');
    }

    /**
     * Process leave approvals or rejections for authorized roles.
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'hr', 'manager'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $leaveRequest = LeaveRequest::with('submittedBy')->findOrFail($id);

        if ($user->role === 'manager') {
            $managerDeptId = $user->employee->department_id;
            if (($leaveRequest->submittedBy->department_id ?? null) !== $managerDeptId) {
                abort(403, 'You can only review leave requests within your department.');
            }
        }

        $leaveRequest->update([
            'status' => $request->input('status'),
            'approved_by' => $user->employee->id ?? null,
        ]);

        return redirect()->route('leave-requests.index')->with('success', "Leave request status updated to {$request->input('status')}!");
    }
}