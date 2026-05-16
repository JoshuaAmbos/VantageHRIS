<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\LeaveRequest;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->enum('leave_type', [LeaveRequest::LEAVE_TYPES])
                ->default(LeaveRequest::LEAVE_TYPE_PERSONAL);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason');
            $table->enum('status', [LeaveRequest::STATUS_PENDING, LeaveRequest::STATUS_APPROVED, LeaveRequest::STATUS_REJECTED])
                ->default(LeaveRequest::STATUS_PENDING);
            $table->foreignId('approved_by')->nullable()->constrained('employees', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
        }
};

