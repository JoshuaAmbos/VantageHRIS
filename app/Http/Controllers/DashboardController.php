<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Employee;

class DashboardController extends Controller
{
    public function index() {
        $totalEmployees = Employee::count();
        $numEmployeesMonth = Employee::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();

        $totalDepartments = Department::count();


        return view('dashboard', compact(
            'totalEmployees',
            'numEmployeesMonth',
            'totalDepartments'));
    }
}
