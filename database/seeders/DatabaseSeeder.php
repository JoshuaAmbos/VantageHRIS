<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Null_;
use function Termwind\terminal;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create test admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@vantage.com',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        // Department
        Department::create([
            'name' => 'IT',
            'description' => 'Department of IT',
            'status' => Department::STATUS_ACTIVE,  
        ]);

        // Employee
        Employee::create([
            'department_id' => 1,
            'first_name' => 'Mitsuha',
            'last_name' => 'Miyamizu',
            'email' => 'miyamizu@vantage.com',
            'phone' => '09756624584',
            'address' => 'Itamori, Japan',
            'position' => Employee::POSITION_SOFTWARE_ENGINEER,
            'hire_date' => Carbon::today(),
            'employment_status' => Employee::STATUS_FULL_TIME,
        ]);

        // Attendance
        Attendance::create([
            'employee_id' => 1,
            'attendance_date' => Carbon::yesterday(),
            'time_in' => '08:00',
            'time_out' => '16:00',
            'status' => Attendance::STATUS_PRESENT,
            'remarks' => NULL,
        ]);

        // Leave Request
        LeaveRequest::create([
            'employee_id' => 1,
            'leave_type' => LeaveRequest::LEAVE_TYPE_PERSONAL,
            'start_date' => Carbon::tomorrow(),
            'end_date' => Carbon::tomorrow()->addDays(7),
            'reason' => 'Urgent out-of-city emergency.',
            'status' => LeaveRequest::STATUS_PENDING,
            'approved_by' => NULL,
        ]);
    }
}
