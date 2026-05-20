<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $user = User::create([
            'name'              => 'System Admin',
            'email'             => 'admin@vantage.com',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'password'          => Hash::make('password'),
        ]);

        $department = Department::first();
        
        if (!$department) {
            $department = Department::create([
                'name'        => 'Administration',
                'description' => 'Core system administration and infrastructure operations.',
                'status'      => 'active',
                'manager_id'  => null,
            ]);
        }

        Employee::create([
            'user_id'           => $user->id,
            'department_id'     => $department->id, 
            'first_name'        => 'System',
            'last_name'         => 'Admin',
            'email'             => 'admin@vantage.com',
            'phone'             => '09000000000',
            'address'           => 'Vantage Enterprise Hub, Suite 101',
            'position'          => 'Administrator',
            'hire_date'         => now()->toDateString(),
            'employment_status' => 'Full-time',
        ]);
    }

    public function down(): void
    {
        Employee::where('email', 'admin@vantage.com')->delete();
        User::where('email', 'admin@vantage.com')->delete();
    }
};