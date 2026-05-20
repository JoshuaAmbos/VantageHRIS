<?php

namespace App\Observers;

use App\Models\Employee;
use App\Models\HrActivity;

class EmployeeObserver
{
    /**
     * Handle the Employee "created" event hooks.
     */
    public function created(Employee $employee): void
    {
        HrActivity::create([
            'user_id'     => auth()->id(),
            'event_type'  => 'employee_created',
            'description' => (auth()->user()->name ?? 'System') . " registered a new employee profile for {$employee->first_name} {$employee->last_name}.",
        ]);
    }

    /**
     * Handle the Employee "updated" event hooks.
     */
    public function updated(Employee $employee): void
    {
        $changedColumn = array_key_first($employee->getChanges());
        $columnLabel = str_replace('_', ' ', $changedColumn ?? 'profile');

        HrActivity::create([
            'user_id'     => auth()->id(),
            'event_type'  => 'employee_updated',
            'description' => (auth()->user()->name ?? 'System') . " modified the {$columnLabel} parameters for {$employee->first_name} {$employee->last_name}.",
        ]);
    }

    /**
     * Handle the Employee "deleted" event hooks.
     */
    public function deleted(Employee $employee): void
    {
        HrActivity::create([
            'user_id'     => auth()->id(),
            'event_type'  => 'employee_deleted',
            'description' => (auth()->user()->name ?? 'System') . " terminated or purged the employee profile of {$employee->first_name} {$employee->last_name}.",
        ]);
    }
}