<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * Employee this record belongs to.
     */
    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }
    
    
}
