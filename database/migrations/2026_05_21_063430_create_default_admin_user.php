<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        User::create([
            'name'              => 'System Admin',
            'email'             => 'admin@vantage.com',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'password'          => Hash::make('adminpassword'),
        ]);
    }

    public function down(): void
    {
        User::where('email', 'admin@vantage.com')->delete();
    }
};