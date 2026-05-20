# Employee Management System (HRIS) using Laravel MVC

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Objectives](#2-objectives)
3. [Scope](#3-scope)
4. [Users and Roles](#4-users-and-roles)
5. [Functional Requirements](#5-functional-requirements)
6. [Non-Functional Requirements](#6-non-functional-requirements)
7. [Proposed Database Tables](#7-proposed-database-tables)
8. [Entity Relationships](#8-entity-relationships)
9. [Suggested Laravel Models](#9-suggested-laravel-models)
10. [Suggested Laravel Controllers](#10-suggested-laravel-controllers)
11. [Suggested Route Groups](#11-suggested-route-groups)
12. [Business Rules](#12-business-rules)
13. [Validation Rules](#13-validation-rules)
14. [Possible Views](#14-possible-views)
15. [Development Tools](#15-development-tools)
16. [Expected Output](#16-expected-output)

## 1. Project Overview

The Employee Management System, also known as a Human Resource Information System (HRIS), is a web-based application designed to help organizations manage employee records, department assignments, attendance tracking, leave requests, and HR reports in one centralized platform.

The system will be developed using the Laravel MVC framework:

- **Model** handles business logic and database interaction
- **View** handles the presentation layer and user interface
- **Controller** processes requests and coordinates models and views

## 2. Objectives

### General Objective

To develop a Laravel-based HRIS that organizes employee information, attendance records, leave requests, and department assignments efficiently.

### Specific Objectives

- Manage employee profiles and employment details
- Track attendance and work status
- Process leave requests and approvals
- Organize employees by department and position
- Generate summary reports for HR monitoring

## 3. Scope

### In Scope

- User authentication and authorization
- Employee management
- Department management
- Attendance tracking
- Leave request management
- Dashboard and reporting
- Role-based access control

### Out of Scope

- Payroll processing
- Biometric device integration
- Recruitment and applicant tracking
- Advanced performance analytics

## 4. Users and Roles

### Admin

- Manage all users
- Manage all employee records
- View all reports
- Configure system settings

### HR Staff

- Add and update employee records
- Manage departments and positions
- Review attendance and leave requests
- Generate HR reports

### Manager

- View department employees
- Approve or reject leave requests
- Monitor attendance of assigned staff

### Employee

- View personal profile
- View attendance history
- Submit leave requests
- Track request status

## 5. Functional Requirements

### 5.1 Authentication Module

**Description:** Handles login, logout, profile management, and role-based access.

**Features:**

- User login
- User logout
- Password hashing
- Role-based middleware
- Profile management

**Laravel MVC Mapping:**

- **Model:** `User`
- **Controller:** `AuthController` or Laravel built-in authentication controllers
- **View:** Login, Register, and Profile pages

### 5.2 Dashboard Module

**Description:** Displays HR summaries and employee activity snapshots.

**Features:**

- Total employees
- Total departments
- Employees present today
- Pending leave requests
- Recent HR activity

**Laravel MVC Mapping:**

- **Model:** `Employee`, `Department`, `Attendance`, `LeaveRequest`
- **Controller:** `DashboardController`
- **View:** Dashboard page

### 5.3 Employee Management Module

**Description:** Stores and manages employee profiles and employment details.

**Features:**

- Add employee
- Edit employee
- Delete employee
- View employee details
- Search and filter employees
- Assign employee to department

**Suggested Fields:**

- Employee ID
- First Name
- Last Name
- Email
- Phone Number
- Address
- Department
- Position
- Hire Date
- Employment Status

**Laravel MVC Mapping:**

- **Model:** `Employee`
- **Controller:** `EmployeeController`
- **View:** Employee list, create, edit, and details pages

### 5.4 Department Management Module

**Description:** Manages organizational departments and employee grouping.

**Features:**

- Add department
- Edit department
- Delete department
- View department list
- Assign manager to department

**Suggested Fields:**

- Department ID
- Department Name
- Description
- Manager ID
- Status

**Laravel MVC Mapping:**

- **Model:** `Department`
- **Controller:** `DepartmentController`
- **View:** Department list and form pages

### 5.5 Attendance Management Module

**Description:** Tracks employee daily attendance and work status.

**Features:**

- Record time in
- Record time out
- View attendance history
- Mark attendance status
- Filter attendance by date or employee

**Suggested Attendance Status:**

- Present
- Late
- Absent
- On Leave

**Suggested Fields:**

- Attendance ID
- Employee ID
- Date
- Time In
- Time Out
- Status
- Remarks

**Laravel MVC Mapping:**

- **Model:** `Attendance`
- **Controller:** `AttendanceController`
- **View:** Attendance list and attendance form pages

### 5.6 Leave Request Module

**Description:** Handles employee leave submissions and approval workflow.

**Features:**

- Submit leave request
- Approve leave request
- Reject leave request
- View leave history
- Track leave request status

**Suggested Fields:**

- Leave Request ID
- Employee ID
- Leave Type
- Start Date
- End Date
- Reason
- Status
- Approved By

**Laravel MVC Mapping:**

- **Model:** `LeaveRequest`
- **Controller:** `LeaveRequestController`
- **View:** Leave request list, create, and details pages

### 5.7 Reports Module

**Description:** Generates summaries for employee and HR monitoring.

**Features:**

- Employee list report
- Attendance summary report
- Leave request report
- Department employee report
- Monthly HR activity report

**Laravel MVC Mapping:**

- **Model:** `Employee`, `Department`, `Attendance`, `LeaveRequest`
- **Controller:** `ReportController`
- **View:** Reports dashboard

## 6. Non-Functional Requirements

- The system must be accessible through a web browser
- The interface must be responsive
- Passwords must be securely hashed
- Only authorized users may access protected modules
- Data must be stored in a relational database
- The system should support CRUD operations efficiently
- The application should follow Laravel coding standards

## 7. Proposed Database Tables

### `users`

- `id`
- `name`
- `email`
- `password`
- `role`
- `created_at`
- `updated_at`

### `departments`

- `id`
- `name`
- `description`
- `manager_id`
- `status`
- `created_at`
- `updated_at`

### `employees`

- `id`
- `user_id` nullable
- `department_id`
- `first_name`
- `last_name`
- `email`
- `phone`
- `address`
- `position`
- `hire_date`
- `employment_status`
- `created_at`
- `updated_at`

### `attendances`

- `id`
- `employee_id`
- `attendance_date`
- `time_in`
- `time_out`
- `status`
- `remarks`
- `created_at`
- `updated_at`

### `leave_requests`

- `id`
- `employee_id`
- `leave_type`
- `start_date`
- `end_date`
- `reason`
- `status`
- `approved_by` nullable
- `created_at`
- `updated_at`

## 8. Entity Relationships

- One department can have many employees
- One employee belongs to one department
- One employee can have many attendance records
- One employee can submit many leave requests
- One manager can approve many leave requests
- One user account may be linked to one employee profile

## 9. Suggested Laravel Models

- `User`
- `Employee`
- `Department`
- `Attendance`
- `LeaveRequest`

## 10. Suggested Laravel Controllers

- `DashboardController`
- `EmployeeController`
- `DepartmentController`
- `AttendanceController`
- `LeaveRequestController`
- `ReportController`
- `AuthController`

## 11. Suggested Route Groups

Use grouped routes instead of `Route::resource()`. Only core routes are included below, not the full set.

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
    });

    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::post('/', [DepartmentController::class, 'store'])->name('store');
    });

    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::post('/time-in', [AttendanceController::class, 'timeIn'])->name('time-in');
        Route::post('/time-out', [AttendanceController::class, 'timeOut'])->name('time-out');
    });

    Route::prefix('leave-requests')->name('leave-requests.')->group(function () {
        Route::get('/', [LeaveRequestController::class, 'index'])->name('index');
        Route::get('/create', [LeaveRequestController::class, 'create'])->name('create');
        Route::post('/', [LeaveRequestController::class, 'store'])->name('store');
        Route::patch('/{leaveRequest}/status', [LeaveRequestController::class, 'updateStatus'])->name('update-status');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
    });
});
```

## 12. Business Rules

- Only authenticated users can access the system
- Only admins can manage user accounts
- Every employee must belong to one department
- Attendance entries must be linked to a valid employee
- A leave request must have a valid start date and end date
- Approved leave requests can only be changed by authorized users
- Reports must only display data allowed by user role
- An employee profile email must be unique

## 13. Validation Rules

### Employee

- First name: required
- Last name: required
- Email: required, valid, unique
- Department ID: required
- Position: required

### Attendance

- Employee ID: required
- Attendance date: required, date
- Status: required

### Leave Request

- Employee ID: required
- Leave type: required
- Start date: required, date
- End date: required, date, after_or_equal:start_date
- Status: required

## 14. Possible Views

- Login page
- Dashboard
- Employee list
- Add employee form
- Edit employee form
- Employee details page
- Department list
- Attendance list
- Leave request page
- Reports page

## 15. Development Tools

- Laravel
- Blade templating engine
- Eloquent ORM
- MySQL or PostgreSQL
- Bootstrap or Tailwind CSS
- Laravel migrations and seeders

## 16. Expected Output

The finished Employee Management System (HRIS) should allow an organization to manage employee records, track attendance, process leave requests, organize departments, and generate HR reports through a structured Laravel MVC web application.
