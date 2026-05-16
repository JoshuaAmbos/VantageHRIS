<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = ['name', 'description', 'manager_id', 'status'];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    /**
     * Employees in this department.
     */
    public function employees(): HasMany {
        return $this->hasMany(Employee::class);
    }

    /**
     * Manager of this department. 
     */
    public function manager(): BelongsTo {
        return $this->belongsTo(Employee::class, 'manager_id', 'id');
    }
}
