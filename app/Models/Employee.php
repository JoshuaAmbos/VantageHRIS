<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * User account of this employee.
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Department this employee belongs to.
     */
    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }

    /**
     * Attendance records of this employee.
     */
    public function attendanceRecords(): HasMany {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Leave requests of this employee.
     */
    public function leaveRequestsSubmitted(): HasMany {
        return $this->hasMany(LeaveRequest::class, 'employee_id');
    }

    /**
     * Leave requests approved by this employee.
     */
    public function leaveRequestsApproved(): HasMany {
        return $this->hasMany(LeaveRequest::class, 'approved_by');
    
    }
}
