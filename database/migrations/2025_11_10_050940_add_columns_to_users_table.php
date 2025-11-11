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
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Only add columns that don't exist
        $columns = [
            'employee_id' => function() use ($table) {
                $table->string('employee_id')->unique()->nullable();
            },
            'department_id' => function() use ($table) {
                $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            },
            'role_id' => function() use ($table) {
                $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            },
            'phone' => function() use ($table) {
                $table->string('phone')->nullable();
            },
            'position' => function() use ($table) {
                $table->string('position')->nullable();
            },
            'is_active' => function() use ($table) {
                $table->boolean('is_active')->default(true);
            },
            'profile_photo_path' => function() use ($table) {
                $table->string('profile_photo_path', 2048)->nullable();
            },
            'date_of_birth' => function() use ($table) {
                $table->date('date_of_birth')->nullable();
            },
            'date_of_joining' => function() use ($table) {
                $table->date('date_of_joining')->nullable();
            },
            'emergency_contact_name' => function() use ($table) {
                $table->string('emergency_contact_name')->nullable();
            },
            'emergency_contact_number' => function() use ($table) {
                $table->string('emergency_contact_number')->nullable();
            },
            'address' => function() use ($table) {
                $table->text('address')->nullable();
            },
            'city' => function() use ($table) {
                $table->string('city')->nullable();
            },
            'state' => function() use ($table) {
                $table->string('state')->nullable();
            },
            'postal_code' => function() use ($table) {
                $table->string('postal_code')->nullable();
            },
            'country' => function() use ($table) {
                $table->string('country')->nullable();
            },
            'timezone' => function() use ($table) {
                $table->string('timezone')->default('UTC');
            },
            'locale' => function() use ($table) {
                $table->string('locale', 10)->default('en');
            },
            'last_login_at' => function() use ($table) {
                $table->timestamp('last_login_at')->nullable();
            },
            'last_login_ip' => function() use ($table) {
                $table->string('last_login_ip')->nullable();
            }
        ];

        foreach ($columns as $column => $callback) {
            if (!Schema::hasColumn('users', $column)) {
                $callback();
            }
        }
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $columns = [
            'employee_id',
            'department_id',
            'role_id',
            'phone',
            'position',
            'is_active',
            'profile_photo_path',
            'date_of_birth',
            'date_of_joining',
            'emergency_contact_name',
            'emergency_contact_number',
            'address',
            'city',
            'state',
            'postal_code',
            'country',
            'timezone',
            'locale',
            'last_login_at',
            'last_login_ip'
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('users', $column)) {
                $table->dropColumn($column);
            }
        }
    });
}
};
