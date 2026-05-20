<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::search($search)->latest()->paginate(10);

        return view('users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new system user.
     */
    public function create()
    {
        $unassignedEmployees = Employee::whereNull('user_id')->get();

        // Roles
        $roles = User::getEnumValues('role');

        return view('users.create', compact('unassignedEmployees', 'roles'));
    }

    /**
     * Store a newly created system user account in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            
            $employee = Employee::findOrFail($validated['employee_id']);

            $user = User::create([
                'name'     => $employee->first_name . ' ' . $employee->last_name,
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => $validated['role'],
            ]);

            $employee->update([
                'user_id' => $user->id
            ]);
        });

        return redirect()->route('users.index')->with('success', 'System login account provisioned successfully!');
    }

    /**
     * Remove the specified user account from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->employee) {
            $user->employee->update([
                'user_id' => null
            ]);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'System account revoked successfully!');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = User::getEnumValues('role');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validated();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            $validatedData = Arr::except($validatedData, ['password', 'password_confirmation']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User account records updated successfully!');
    }

}