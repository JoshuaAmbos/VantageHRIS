<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        if ($user->role === User::ROLE_MANAGER) {
            $managerDeptId = $user->employee->department_id ?? null;
            $departments = Department::search($search)->where('id', $managerDeptId)->paginate(7)->withQueryString();
        } else {
            $departments = Department::search($search)->latest()->paginate(7)->withQueryString();
        }

        return view('departments.index', compact('departments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $departments = Department::all();
        return view('departments.create', compact('employees', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();
        $department = Department::create($validated);

        // Auto-upgrade the assigned employee to the manager role if one is set
        if (!empty($validated['manager_id'])) {
            $employee = Employee::find($validated['manager_id']);
            if ($employee && $employee->user && $employee->user->role === 'employee') {
                $employee->user->update(['role' => 'manager']);
            }
        }

        return redirect()->route('departments.index')->with('success', 'Department successfully added!');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with(['employees', 'manager'])->findOrFail($id);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        $employees = Employee::all();
        return view('departments.edit', compact('department', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $validated = $request->validated();
        $department = Department::findOrFail($id);

        // Capture the previous manager ID to check if the assignment is changing
        $oldManagerId = $department->manager_id;

        $department->update($validated);

        // If the manager has been updated or removed, sync user roles accordingly
        if ((int)$oldManagerId !== (int)$department->manager_id) {
            
            // Demote the previous manager if they don't manage any other departments
            if ($oldManagerId) {
                $oldManager = Employee::find($oldManagerId);
                if ($oldManager && $oldManager->user) {
                    $stillManagesCount = Department::where('manager_id', $oldManagerId)->count();
                    if ($stillManagesCount === 0 && $oldManager->user->role === 'manager') {
                        $oldManager->user->update(['role' => 'employee']);
                    }
                }
            }

            // Upgrade the newly assigned manager
            if ($department->manager_id) {
                $newManager = Employee::find($department->manager_id);
                if ($newManager && $newManager->user && $newManager->user->role === 'employee') {
                    $newManager->user->update(['role' => 'manager']);
                }
            }
        }

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $managerId = $department->manager_id;

        $department->delete();

        // Demote the manager if they aren't assigned to any remaining departments
        if ($managerId) {
            $manager = Employee::find($managerId);
            if ($manager && $manager->user) {
                $stillManagesCount = Department::where('manager_id', $managerId)->count();
                if ($stillManagesCount === 0 && $manager->user->role === 'manager') {
                    $manager->user->update(['role' => 'employee']);
                }
            }
        }

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }
}