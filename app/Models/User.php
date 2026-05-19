<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_EMPLOYEE = 'employee';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_HR = 'hr';
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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
     * Employee profile of this user.
     */
    public function employee(): HasOne {
        return $this->hasOne(Employee::class);
    }
}
