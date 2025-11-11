<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'System Administrator', 'is_active' => true],
            ['name' => 'HOD', 'slug' => 'hod', 'description' => 'Head of Department', 'is_active' => true],
            ['name' => 'HOD IT', 'slug' => 'hod-it', 'description' => 'Head of IT Department', 'is_active' => true],
            ['name' => 'IT Staff', 'slug' => 'it-staff', 'description' => 'IT Support Staff', 'is_active' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
