<?php

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
        Schema::create('request_forms', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('form_code'); // ITF001, ITF002, etc.
            $table->string('form_title');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('department');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nric')->nullable();
            $table->json('request_data')->nullable(); // Store all form fields as JSON
            $table->string('status')->default('pending'); // pending, verified_hod, approved, rejected, completed

            // HOD verification
            $table->foreignId('hod_verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('hod_verified_at')->nullable();

            // HOD IT approval
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();

            // Rejection
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();

            // Assignment to IT Staff
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('assigned_at')->nullable();

            // Completion
            $table->timestamp('completed_at')->nullable();
            $table->text('completion_notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('department');
            $table->index('form_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_forms');
    }
};
