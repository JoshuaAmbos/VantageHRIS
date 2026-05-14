<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'department_id', 'first_name', 'last_name',
        'email', 'phone', 'address', 'position', 'hire_date', 'employment_status'
    ];

    // Positions 
    public const POSITION_ADMIN = 'Administrator';

    public const POSITION_MANAGER = 'Manager';
    public const POSITION_HR_STAFF = 'HR Staff';
    public const POSITION_SOFTWARE_ENGINEER = 'Software Engineer';
    public const POSITION_ACCOUNTANT = 'Accountant';

    // Employment Statuses
    public const STATUS_FULL_TIME = 'Full-time';
    public const STATUS_PART_TIME = 'Part-time';

    public const POSITIONS = [
        self::POSITION_ADMIN,
        self::POSITION_MANAGER,
        self::POSITION_HR_STAFF,
        self::POSITION_SOFTWARE_ENGINEER,
        self::POSITION_ACCOUNTANT,
    ];

    public const EMPLOYMENT_STATUSES = [
        self::STATUS_FULL_TIME,
        self::STATUS_PART_TIME,
    ];
}
