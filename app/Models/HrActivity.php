<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HrActivity extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'event_type'
    ];

    /**
     * Get the system user account responsible for this specific activity log entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}