<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

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

    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'status',
        'approved_by',
    ];

    /**
     * Get the enum values of a specific column.
     * Fixed to use native PHP lookups instead of MySQL proprietary syntax.
     * @param string $column
     * @return string[]
     */
    public static function getEnumValues(string $column): array
    {
        if ($column === 'leave_type') {
            return self::LEAVE_TYPES;
        }

        if ($column === 'status') {
            return self::STATUSES;
        }

        return [];
    }

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
        return $this->belongsTo(Employee::class, 'approved_by', 'id');
    }

    /**
     * Scope search
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('leave_type', 'LIKE', "%{$term}%")
            ->orWhere('status', 'LIKE', "%{$term}%")
            ->orWhere('reason', 'LIKE', "%{$term}%")
            ->orWhereHas('submittedBy', function (Builder $empQuery) use ($term) {
                $empQuery->where('first_name', 'LIKE', "%{$term}%")
                        ->orWhere('last_name', 'LIKE', "%{$term}%")
                        ->orWhere('position', 'LIKE', "%{$term}%");
            });
        });
    }
}