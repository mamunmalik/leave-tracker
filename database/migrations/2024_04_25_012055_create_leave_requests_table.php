<?php

use App\Enums\LeaveType;
use App\Enums\LeaveStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->enum('leave_type', [LeaveType::CASUAL->name, LeaveType::SICK->name, LeaveType::EMERGENCY->name]);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('leave_reason');
            $table->enum('status', [LeaveStatus::PENDING->name, LeaveStatus::APPROVED->name, LeaveStatus::REJECTED->name])->default(LeaveStatus::PENDING->name);
            $table->string('comments')->nullable();
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
