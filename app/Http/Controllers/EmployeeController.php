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
        $user = auth()->user();

        // Start base query with local search criteria
        $query = Employee::search($search);

        // FIXED: Restrict managers strictly to their own assigned team headcount
        if ($user->role === 'manager') {
            $managerDeptId = $user->employee->department_id ?? null;
            $query->where('department_id', $managerDeptId);
        }

        $employees = $query->latest()->paginate(7)->withQueryString();

        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Managers should not manually onboard new entries via this controller
        if (auth()->user()->role === 'manager') {
            abort(403, 'Unauthorized administrative request action.');
        }

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
        if (auth()->user()->role === 'manager') {
            abort(403, 'Unauthorized administrative request action.');
        }

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
        $user = auth()->user();
        $employee = Employee::with('department')->findOrFail($id);

        // Prevent managers from accessing out-of-department profiles
        if ($user->role === 'manager' && $employee->department_id !== ($user->employee->department_id ?? null)) {
            abort(403, 'Unauthorized scope access boundary request.');
        }

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $employee = Employee::findOrFail($id);

        // Enforce access barriers on modification form requests
        if ($user->role === 'manager' && $employee->department_id !== ($user->employee->department_id ?? null)) {
            abort(403, 'Unauthorized scope access boundary request.');
        }

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
        $user = auth()->user();
        $employee = Employee::findOrFail($id);

        // FIXED: Secure database mutation layers from cross-tenant input submission parametrs
        if ($user->role === 'manager' && $employee->department_id !== ($user->employee->department_id ?? null)) {
            abort(403, 'Unauthorized scope access boundary request.');
        }

        $validated = $request->validated();
        $employee->update($validated);

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
        $user = auth()->user();
        $employee = Employee::findOrFail($id);
        
        // Enforce absolute destructive override safety constraints
        if ($user->role === 'manager') {
            abort(403, 'Managers lack system privileges to execute removal procedures.');
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
}