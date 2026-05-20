<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
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
     * @param string $column
     * @return string[]
     */
    public static function getEnumValues(string $column): array
    {
        // Fetch the target table string name (attendances)
        $table = (new static)->getTable();

        // Pass the string query directly to DB::select() without DB::raw()
        $result = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'");

        // Safety check: if column doesn't exist, return an empty array to prevent null pointer crashes
        if (empty($result)) {
            return [];
        }

        $type = $result[0]->Type;

        // Parse the string structure: enum('present','absent','leave')
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        
        if (!isset($matches[1])) {
            return [];
        }

        $values = [];
        foreach (explode(',', $matches[1]) as $value) {
            $values[] = trim($value, "'");
        }

        return $values;
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
