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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('profile_image')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->boolean('admin')->default(0);
            $table->string('completed_tasks')->default(0);
            $table->string('pending_tasks')->default(0);
            $table->string('respected_tasks')->default(0);
            $table->string('unrespected_tasks')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
