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
        Schema::create('failed_login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45); // Supports IPv6
            $table->string('email')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('attempted_at');
            $table->timestamp('blocked_until')->nullable();
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('ip_address');
            $table->index('attempted_at');
            $table->index('blocked_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_login_attempts');
    }
};
