<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $employees = Employee::search($search)->latest()->paginate(7)->withQueryString();

        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Employee::POSITIONS;
        $statuses = Employee::EMPLOYMENT_STATUSES;

        return view('employees.create', compact('departments', 'positions', 'statuses'));
    }

    /**
     * Store a newly created resource in storage and auto-provision system credentials.
     */
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();

        $role = 'employee';
        if ($validated['position'] === Employee::POSITION_ADMIN) {
            $role = 'admin';
        } elseif ($validated['position'] === Employee::POSITION_MANAGER) {
            $role = 'manager';
        } elseif ($validated['position'] === Employee::POSITION_HR_STAFF) {
            $role = 'hr';
        }

        $user = User::create([
            'name'     => $validated['first_name'] . ' ' . $validated['last_name'],
            'email'    => $validated['email'],
            'role'     => $role,
            'password' => Hash::make('password'),
        ]);

        $validated['user_id'] = $user->id;
        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee profile and system credentials provisioned successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('department')->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Employee::POSITIONS;
        $statuses = Employee::EMPLOYMENT_STATUSES;

        return view('employees.edit', compact('employee', 'departments', 'positions', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {        
        $employee = Employee::findOrFail($id);
        $validated = $request->validated();

        $employee->update($validated);

        // Keep the connected user profile email in sync with the employee profile record
        if ($employee->user) {
            $employee->user->update([
                'name'  => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}