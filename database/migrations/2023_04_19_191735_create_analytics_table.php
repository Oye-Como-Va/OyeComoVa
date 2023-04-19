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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('date_real');
            $table->time('start_time');
            $table->time('start_time_real');
            $table->time('end_time');
            $table->time('end_time_real');
            $table->unsignedBigInteger('working_area_id');
            $table->foreign('working_area_id')->references('id')->on('working_areas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
