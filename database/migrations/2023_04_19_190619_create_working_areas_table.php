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
        Schema::create('working_areas', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('date_real');
            $table->time('start_time');
            $table->time('start_time_real');
            $table->time('end_time');
            $table->time('end_time_real')->nullable()->default(null);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_areas');
    }
};
