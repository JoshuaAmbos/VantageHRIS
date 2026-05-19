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
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database based on strict hris_system dump rules.
     */
    public function run(): void
    {
        // 1. SEED DEPARTMENTS: Exactly 5 items matching your database schema text descriptions
        $departmentsData = [
            ['name' => 'IT Department', 'desc' => 'Software engineering and local systems support.'],
            ['name' => 'Human Resources', 'desc' => 'Talent acquisition, payroll operations, and employee success.'],
            ['name' => 'Finance & Accounting', 'desc' => 'Corporate fiscal management and expense processing.'],
            ['name' => 'Marketing & Brand', 'desc' => 'Public relations, social outreach campaigns, and copy management.'],
            ['name' => 'Operations', 'desc' => 'On-site logistics management and facilities maintenance.']
        ];

        $departmentIds = [];
        foreach ($departmentsData as $dept) {
            $createdDept = Department::create([
                'name'        => $dept['name'],
                'description' => $dept['desc'],
                'manager_id'  => null, // Kept null initially to avoid key loops
                'status'      => 'active',
            ]);
            $departmentIds[] = $createdDept->id;
        }

        // 2. SEED WORKFORCE MATRIX: Exactly 5 unique records to satisfy constraints
        // Matches the enum whitelist: 'Administrator', 'Manager', 'HR Staff', 'Software Engineer', 'Accountant'
        $workforceData = [
            [
                'first' => 'Mitsuha', 'last' => 'Miyamizu', 'email' => 'miyamizu@vantage.com',
                'phone' => '09756624584', 'address' => 'Itamori, Japan', 'position' => 'Software Engineer',
                'role'  => 'employee', 'dept_idx' => 0
            ],
            [
                'first' => 'Taki', 'last' => 'Tachibana', 'email' => 'tachibana@vantage.com',
                'phone' => '09123456789', 'address' => 'Tokyo, Japan', 'position' => 'Manager',
                'role'  => 'manager', 'dept_idx' => 0
            ],
            [
                'first' => 'Hina', 'last' => 'Amano', 'email' => 'amano@vantage.com',
                'phone' => '09224466880', 'address' => 'Yoyogi, Japan', 'position' => 'HR Staff',
                'role'  => 'hr', 'dept_idx' => 1
            ],
            [
                'first' => 'Hodaka', 'last' => 'Morishima', 'email' => 'morishima@vantage.com',
                'phone' => '09113355779', 'address' => 'Shinjuku, Japan', 'position' => 'Accountant',
                'role'  => 'employee', 'dept_idx' => 2
            ],
            [
                'first' => 'Sayaka', 'last' => 'Natori', 'email' => 'natori@vantage.com',
                'phone' => '09887766554', 'address' => 'Nagano, Japan', 'position' => 'Administrator',
                'role'  => 'admin', 'dept_idx' => 4
            ]
        ];

        $employeeIds = [];
        foreach ($workforceData as $index => $data) {
            
            // Step A: Provision the login account model entry first to gain user primary key
            $user = User::create([
                'name'     => $data['first'] . ' ' . $data['last'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
                'role'     => $data['role'],
            ]);

            // Step B: Create employee detail record mapped strictly to the user id key
            $employee = Employee::create([
                'user_id'           => $user->id,
                'department_id'     => $departmentIds[$data['dept_idx']],
                'first_name'        => $data['first'],
                'last_name'         => $data['last'],
                'email'             => $data['email'],
                'phone'             => $data['phone'],
                'address'           => $data['address'],
                'position'          => $data['position'],
                'hire_date'         => Carbon::today()->subMonths(12)->addDays($index),
                'employment_status' => 'Full-time',
            ]);

            $employeeIds[] = $employee->id;

            // Optional: If this employee is a Manager, assign them as the manager of their department
            if ($data['position'] === 'Manager') {
                Department::where('id', $employee->department_id)->update([
                    'manager_id' => $employee->id
                ]);
            }
        }

        // 3. SEED ATTENDANCES: Exactly 5 unique log profiles matching table structure
        // Matches the enum whitelist: 'present', 'late', 'absent', 'on leave'
        $attendanceStatuses = ['present', 'present', 'late', 'present', 'on leave'];
        $attendanceRemarks  = [null, null, 'Delayed by local transit routing', null, 'Approved personal leave request window'];

        foreach ($employeeIds as $index => $empId) {
            Attendance::create([
                'employee_id'     => $empId,
                'attendance_date' => Carbon::yesterday()->subDays($index),
                'time_in'         => '08:00:00',
                'time_out'        => '17:00:00',
                'status'          => $attendanceStatuses[$index],
                'remarks'         => $attendanceRemarks[$index],
            ]);
        }

        // 4. SEED LEAVE REQUESTS: Exactly 5 log rows satisfying constraint links
        // Matches the enum whitelist: 'Vacation', 'Sick', 'Personal', 'Maternity', 'Paternity', 'Bereavement', 'Unpaid'
        $leaveTypes = ['Personal', 'Vacation', 'Sick', 'Personal', 'Vacation'];
        $statuses    = ['Pending', 'Approved', 'Rejected', 'Pending', 'Approved'];
        $reasons    = [
            'Urgent out-of-city personal emergency requirements.',
            'Scheduled family vacation travel package operations.',
            'Routine medical dental consultation extraction recovery.',
            'Home appliance repair coordination timeframe.',
            'Annual rest allocation window.'
        ];

        foreach ($employeeIds as $index => $empId) {
            LeaveRequest::create([
                'employee_id' => $empId,
                'leave_type'  => $leaveTypes[$index],
                'start_date'  => Carbon::tomorrow()->addWeeks($index)->toDateString(),
                'end_date'    => Carbon::tomorrow()->addWeeks($index)->addDays(3)->toDateString(),
                'reason'      => $reasons[$index],
                'status'      => $statuses[$index],
                // If approved, point foreign key back safely to Employee ID #2 (Our designated Manager Taki)
                'approved_by' => $statuses[$index] === 'Approved' ? $employeeIds[1] : null,
            ]);
        }
    }
}