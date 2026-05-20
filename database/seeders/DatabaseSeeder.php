<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\HrActivity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users & Logins
        $usersData = [
            // Default ADMIN account
            ['name' => 'System Admin', 'email' => 'admin@vantage.com', 'role' => 'admin', 'pass' => 'password'],
            
            // Dummy
            ['name' => 'Alice Vance', 'email' => 'vance@vantage.com', 'role' => 'admin', 'pass' => 'password'],
            ['name' => 'Robert Miller', 'email' => 'miller@vantage.com', 'role' => 'manager', 'pass' => 'password'],
            ['name' => 'Elena Rostova', 'email' => 'rostova@vantage.com', 'role' => 'hr', 'pass' => 'password'],
            ['name' => 'David Kim', 'email' => 'kim@vantage.com', 'role' => 'employee', 'pass' => 'password'],
            ['name' => 'Sarah Jenkins', 'email' => 'jenkins@vantage.com', 'role' => 'employee', 'pass' => 'password'],
            ['name' => 'Michael Chang', 'email' => 'chang@vantage.com', 'role' => 'manager', 'pass' => 'password'],
            ['name' => 'Amanda Ross', 'email' => 'ross@vantage.com', 'role' => 'hr', 'pass' => 'password'],
            ['name' => 'James Foster', 'email' => 'foster@vantage.com', 'role' => 'employee', 'pass' => 'password'],
            ['name' => 'Jessica Taylor', 'email' => 'taylor@vantage.com', 'role' => 'employee', 'pass' => 'password'],
            ['name' => 'Marcus Brody', 'email' => 'brody@vantage.com', 'role' => 'manager', 'pass' => 'password'],
        ];

        $userMap = [];
        foreach ($usersData as $u) {
            $userMap[$u['email']] = User::create([
                'name'              => $u['name'],
                'email'             => $u['email'],
                'email_verified_at' => now(),
                'password'          => Hash::make($u['pass']),
                'role'              => $u['role'],
            ]);
        }

        // Departments
        $departmentsData = [
            'IT'        => ['name' => 'IT Department', 'desc' => 'Software engineering, continuous integration, and local helpdesk pipelines.'],
            'Marketing' => ['name' => 'Marketing & Brand', 'desc' => 'Public relations, social media marketing campaigns, and growth metrics.'],
            'Finance'   => ['name' => 'Finance & Accounting', 'desc' => 'Corporate wealth optimization, tax tracking, and payroll disbursements.'],
            'HR'        => ['name' => 'Human Resources', 'desc' => 'Talent acquisition strategy, performance evaluations, and employee wellness.'],
        ];

        $deptMap = [];
        foreach ($departmentsData as $key => $d) {
            $deptMap[$key] = Department::create([
                'name'        => $d['name'],
                'description' => $d['desc'],
                'manager_id'  => null,
                'status'      => 'active',
            ]);
        }

        // Employees
        $employeeSpecs = [
            ['email' => 'admin@vantage.com', 'first' => 'System', 'last' => 'Admin', 'pos' => 'Administrator', 'status' => 'Full-time', 'dept' => 'IT', 'phone' => '09000000000'],
            
            ['email' => 'vance@vantage.com', 'first' => 'Alice', 'last' => 'Vance', 'pos' => 'Administrator', 'status' => 'Full-time', 'dept' => 'IT', 'phone' => '09112223333'],
            ['email' => 'miller@vantage.com', 'first' => 'Robert', 'last' => 'Miller', 'pos' => 'Manager', 'status' => 'Full-time', 'dept' => 'IT', 'phone' => '09123456789'],
            ['email' => 'kim@vantage.com', 'first' => 'David', 'last' => 'Kim', 'pos' => 'Software Engineer', 'status' => 'Full-time', 'dept' => 'IT', 'phone' => '09756624584'],
            ['email' => 'taylor@vantage.com', 'first' => 'Jessica', 'last' => 'Taylor', 'pos' => 'Software Engineer', 'status' => 'Part-time', 'dept' => 'IT', 'phone' => '09441122334'],
            
            ['email' => 'brody@vantage.com', 'first' => 'Marcus', 'last' => 'Brody', 'pos' => 'Manager', 'status' => 'Full-time', 'dept' => 'Marketing', 'phone' => '09556677889'],
            ['email' => 'jenkins@vantage.com', 'first' => 'Sarah', 'last' => 'Jenkins', 'pos' => 'Software Engineer', 'status' => 'Full-time', 'dept' => 'Marketing', 'phone' => '09113355779'],
            
            ['email' => 'chang@vantage.com', 'first' => 'Michael', 'last' => 'Chang', 'pos' => 'Manager', 'status' => 'Full-time', 'dept' => 'Finance', 'phone' => '09456321845'],
            ['email' => 'foster@vantage.com', 'first' => 'James', 'last' => 'Foster', 'pos' => 'Accountant', 'status' => 'Full-time', 'dept' => 'Finance', 'phone' => '09332211445'],
            
            ['email' => 'rostova@vantage.com', 'first' => 'Elena', 'last' => 'Rostova', 'pos' => 'HR Staff', 'status' => 'Full-time', 'dept' => 'HR', 'phone' => '09224466880'],
            ['email' => 'ross@vantage.com', 'first' => 'Amanda', 'last' => 'Ross', 'pos' => 'HR Staff', 'status' => 'Part-time', 'dept' => 'HR', 'phone' => '09667788990'],
        ];

        $employees = [];
        foreach ($employeeSpecs as $spec) {
            $user = $userMap[$spec['email']];
            $dept = $deptMap[$spec['dept']];

            $employees[] = Employee::create([
                'user_id'           => $user->id,
                'department_id'     => $dept->id,
                'first_name'        => $spec['first'],
                'last_name'         => $spec['last'],
                'email'             => $spec['email'],
                'phone'             => $spec['phone'],
                'address'           => 'Vantage Enterprise Hub, Suite ' . rand(100, 500),
                'position'          => $spec['pos'],
                'hire_date'         => Carbon::today()->subMonths(rand(6, 24))->toDateString(),
                'employment_status' => $spec['status'],
            ]);
        }

        // Updated positional array indicators due to the new account sequence addition
        $deptMap['IT']->update(['manager_id' => $employees[2]->id]); // Robert Miller
        $deptMap['Marketing']->update(['manager_id' => $employees[5]->id]); // Marcus Brody
        $deptMap['Finance']->update(['manager_id' => $employees[7]->id]); // Michael Chang

        $managers = [$employees[2], $employees[5], $employees[7]];

        // Attendance History (30 Business Days)
        $businessDays = [];
        $current = Carbon::today();
        
        while (count($businessDays) < 30) {
            if (!$current->isWeekend()) {
                $businessDays[] = $current->toDateString();
            }
            $current->subDay();
        }

        foreach ($businessDays as $date) {
            foreach ($employees as $emp) {
                if (rand(1, 40) === 40) continue;

                $roll = rand(1, 100);
                if ($roll <= 82) {
                    $status = 'present';
                    $timeIn = '08:00:00';
                    $remarks = null;
                } elseif ($roll <= 92) {
                    $status = 'late';
                    $timeIn = '08:' . rand(15, 45) . ':00';
                    $remarks = 'Delayed during morning transit window.';
                } elseif ($roll <= 96) {
                    $status = 'absent';
                    $timeIn = '00:00:00';
                    $remarks = 'Unexcused absence profile.';
                } else {
                    $status = 'on leave';
                    $timeIn = '00:00:00';
                    $remarks = 'Approved strategic leave block window.';
                }

                Attendance::create([
                    'employee_id'     => $emp->id,
                    'attendance_date' => $date,
                    'time_in'         => $timeIn,
                    'time_out'        => $status === 'present' || $status === 'late' ? '17:00:00' : '00:00:00',
                    'status'          => $status,
                    'remarks'         => $remarks,
                    'created_at'      => Carbon::parse($date)->setHour(18),
                    'updated_at'      => Carbon::parse($date)->setHour(18),
                ]);
            }
        }

        // Leave Requests
        $leaveReasons = [
            'Urgent family commitment requirements.',
            'Scheduled out-of-city medical consultation tracking.',
            'Rest and recuperation breaks.',
            'Moving to a new permanent residential property address.',
        ];

        $leaveTypes = ['Vacation', 'Sick', 'Personal', 'Unpaid'];

        foreach ($employees as $index => $emp) {
            // Bypass manager profile updates to match original loop metrics
            if (in_array($emp->id, [3, 6, 8])) continue; 

            LeaveRequest::create([
                'employee_id' => $emp->id,
                'leave_type'  => $leaveTypes[rand(0, 2)],
                'start_date'  => Carbon::today()->subWeeks(3)->toDateString(),
                'end_date'    => Carbon::today()->subWeeks(3)->addDays(3)->toDateString(),
                'reason'      => $leaveReasons[rand(0, 3)],
                'status'      => 'Approved',
                'approved_by' => $managers[rand(0, 2)]->id,
                'created_at'  => Carbon::parse(Carbon::today()->subWeeks(4))->toDateTimeString(),
            ]);

            if ($index % 2 === 0) {
                LeaveRequest::create([
                    'employee_id' => $emp->id,
                    'leave_type'  => $leaveTypes[rand(0, 3)],
                    'start_date'  => Carbon::today()->addWeeks(1)->toDateString(),
                    'end_date'    => Carbon::today()->addWeeks(1)->addDays(2)->toDateString(),
                    'reason'      => 'Personal business and family task management execution.',
                    'status'      => 'Pending',
                    'approved_by' => null,
                    'created_at'  => Carbon::parse(Carbon::today()->subDays(2))->toDateTimeString(),
                ]);
            }
        }

        // Audit Logs
        $hrStaffUser = $userMap['rostova@vantage.com'];
        $adminUser   = $userMap['vance@vantage.com'];

        $activities = [
            ['user' => $adminUser, 'type' => 'employee_created', 'desc' => 'Alice Vance provisioned a new administrative user profile footprint for Marcus Brody.', 'offset' => 12],
            ['user' => $hrStaffUser, 'type' => 'employee_created', 'desc' => 'Elena Rostova registered an incoming employee record for Jessica Taylor.', 'offset' => 10],
            ['user' => $adminUser, 'type' => 'employee_updated', 'desc' => 'Alice Vance updated the departmental mapping properties for Amanda Ross.', 'offset' => 8],
            ['user' => $hrStaffUser, 'type' => 'leave_approved', 'desc' => 'Elena Rostova signed off and approved the vacation window request for David Kim.', 'offset' => 5],
            ['user' => $adminUser, 'type' => 'employee_updated', 'desc' => 'Alice Vance changed the system access authorization roles for Robert Miller.', 'offset' => 1],
        ];

        foreach ($activities as $act) {
            HrActivity::create([
                'user_id'     => $act['user']->id,
                'event_type'  => $act['type'],
                'description' => $act['desc'],
                'created_at'  => Carbon::now()->subDays($act['offset']),
                'updated_at'  => Carbon::now()->subDays($act['offset']),
            ]);
        }
    }
}