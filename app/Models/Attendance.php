<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Attendance extends Model
{
    public const STATUS_PRESENT = 'present';
    public const STATUS_LATE = 'late';
    public const STATUS_ABSENT = 'absent';
    public const STATUS_ON_LEAVE = 'on leave';

    public const STATUSES = [
        self::STATUS_PRESENT,
        self::STATUS_LATE,
        self::STATUS_ABSENT,
        self::STATUS_ON_LEAVE,
    ];

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'time_in',
        'time_out',
        'status',
        'remarks'
    ];

    /**
     * Retrieve enum values for a specific column.
     * Fixed to use native PHP lookups instead of MySQL proprietary syntax.
     * * @param string $column
     * @return array
     */
    public static function getEnumValues(string $column): array
    {
        // Route column targets cleanly inside PHP memory
        if ($column === 'status') {
            return self::STATUSES;
        }

        return [];
    }

    /**
     * Employee this record belongs to.
     */
    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Query search for this model.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('status', 'LIKE', "%{$term}%")
            ->orWhere('remarks', 'LIKE', "%{$term}%")
            ->orWhereHas('employee', function (Builder $empQuery) use ($term) {
                $empQuery->where('first_name', 'LIKE', "%{$term}%")
                ->orWhere('last_name', 'LIKE', "%{$term}%")
                ->orWhere('position', 'LIKE', "%{$term}%");
            });
        });
    }
}