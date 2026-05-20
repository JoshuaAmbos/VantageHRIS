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
            $departments = Department::where('id', $managerDeptId)->get();
        } else {
            $departments = Department::search($search)->latest()->paginate(10);
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
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department succesfully added!');    
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
        $department = Department::findOrFail($id);
        $employees = Employee::all();
        return view('departments.edit', compact('department', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        // 1. Get the data that passed validation in DepartmentRequest
        $validated = $request->validated();

        // 2. Find the specific department or throw a 404 error if not found
        $department = Department::findOrFail($id);

        // 3. Update the retrieved instance with the validated data
        $department->update($validated);

        // 4. Redirect back to the list with a success message
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }
}
