<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{

    // Common Leave Types
    public const LEAVE_TYPE_VACATION = 'Vacation';
    public const LEAVE_TYPE_SICK = 'Sick';
    public const LEAVE_TYPE_PERSONAL = 'Personal';
    public const LEAVE_TYPE_MATERNITY = 'Maternity';
    public const LEAVE_TYPE_PATERNITY = 'Paternity';
    public const LEAVE_TYPE_BEREAVEMENT = 'Bereavement';
    public const LEAVE_TYPE_UNPAID = 'Unpaid';

    // Statuses
    public const STATUS_PENDING = 'Pending';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';

    public const LEAVE_TYPES = [
        self::LEAVE_TYPE_VACATION,
        self::LEAVE_TYPE_SICK,
        self::LEAVE_TYPE_PERSONAL,
        self::LEAVE_TYPE_MATERNITY,
        self::LEAVE_TYPE_PATERNITY,
        self::LEAVE_TYPE_BEREAVEMENT,
        self::LEAVE_TYPE_UNPAID,
    ];

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
    ];

    /**
     * Employee that submitted this request.
     */
    public function submittedBy(): BelongsTo {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Manager employee that approved this request.
     */
    public function approvedBy(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }
}
