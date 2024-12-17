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
    // Create users table if it doesn't already exist
    if (!Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id'); // Primary key as 'user_id'
            $table->string('name', 100); // Limit name to 100 characters
            $table->string('email', 100)->unique(); // Limit email to 100 characters
            $table->string('password', 100); // Limit password to 100 characters
            $table->string('mobile_number', 15)->nullable(); // Optional mobile number with a max length of 15
            $table->string('address', 255)->nullable(); // Optional address with a max length of 255
            $table->string('role', 50); // Role field with a max length of 50
            $table->timestamp('email_verified_at')->nullable(); // Optional email verification timestamp
            $table->rememberToken();
            $table->timestamps();
        });
    }


        // Create password reset tokens table if it doesn't already exist
        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        // Create sessions table if it doesn't already exist
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables in reverse order to avoid dependency issues
        Schema::dropIfExists('session');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
