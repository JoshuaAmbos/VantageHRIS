<?php

use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->enum('position', [Employee::POSITIONS])
                ->default(Employee::POSITION_SOFTWARE_ENGINEER);
            $table->date('hire_date');
            $table->enum('employment_status', [Employee::EMPLOYMENT_STATUSES])
                ->default(Employee::STATUS_FULL_TIME);
            $table->timestamps();
        });

        // manager_id FK on Departments Table
        Schema::table('departments', function (Blueprint $table){
             $table->foreignId('manager_id')->nullable()->after('description')->constrained('employees', 'id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
