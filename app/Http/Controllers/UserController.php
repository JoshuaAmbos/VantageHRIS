<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new system user.
     */
    public function create()
    {
        // Fetch only employees who DO NOT have a user account linked yet
        $unassignedEmployees = Employee::whereNull('user_id')->get();

        // Roles
        $roles = User::getEnumValues('role');

        return view('users.create', compact('unassignedEmployees', 'roles'));
    }

    /**
     * Store a newly created system user account in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        // Use a database transaction to ensure BOTH records update successfully together
        DB::transaction(function () use ($validated) {
            
            // Fetch the active employee record targeted by the admin
            $employee = Employee::findOrFail($validated['employee_id']);

            // Create the new authentication user account row
            $user = User::create([
                'name'     => $employee->first_name . ' ' . $employee->last_name,
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'],
            ]);

            // Connect the inverse relationship link back to the employee
            $employee->update([
                'user_id' => $user->id
            ]);
        });

        return redirect()->route('users.index')->with('success', 'System login account provisioned successfully!');
    }

    /**
     * Remove the specified user account from storage.
     * 
     * @param  User  $user  -> Optimized using implicit route-model binding
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        // Check if this user is linked to an employee profile
        if ($user->employee) {
            $user->employee->update([
                'user_id' => null
            ]);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'System account revoked successfully!');
    }
}