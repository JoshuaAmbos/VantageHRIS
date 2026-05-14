<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public const LEAVE_TYPES = [
        self::LEAVE_TYPE_VACATION,
        self::LEAVE_TYPE_SICK,
        self::LEAVE_TYPE_PERSONAL,
        self::LEAVE_TYPE_MATERNITY,
        self::LEAVE_TYPE_PATERNITY,
        self::LEAVE_TYPE_BEREAVEMENT,
        self::LEAVE_TYPE_UNPAID,
    ];
}
