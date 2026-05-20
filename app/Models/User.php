<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

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
        $table = (new static)->getTable();
        $result = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'");

        if (empty($result)) {
            return [];
        }

        $type = $result[0]->Type;

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

    /**
     * Query search for this model across account name, login email, and system access role.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('role', 'LIKE', "%{$term}%");
        });
    }
}
