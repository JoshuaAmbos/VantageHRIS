<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
     * Retrive enum values for a specific column.
     * @param string column
     * @return array
     */
    public static function getEnumValues(string $column): array
    {
        // Fetch the target table string name
        $table = (new static)->getTable();

        // Pass the string query directly to DB::select() without DB::raw()
        $result = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'");

        // Safety check: if column doesn't exist, return an empty array to prevent null pointer crashes
        if (empty($result)) {
            return [];
        }

        $type = $result[0]->Type;

        //  Parse the string structure
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
     * Employee this record belongs to.
     */
    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }

    
    
}
