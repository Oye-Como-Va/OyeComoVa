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
        Schema::create('achievement_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('achievement_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER tr_user_achievements AFTER UPDATE ON users ' .
            ' FOR EACH ROW '.
            ' BEGIN ' .
                ' IF NEW.completed_tasks > 1 THEN '.
                    ' INSERT INTO achievement_user (user_id, achievement_id, created_at) VALUES (NEW.id, 1, NOW()); '.
                ' END IF; ' .
                ' IF NEW.completed_tasks > 5 THEN ' .
                    ' INSERT INTO achievement_user (user_id, achievement_id, created_at) VALUES (NEW.id, 2, NOW()); ' .
                ' END IF; ' .

            ' END; '
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement_user');
        DB::unprepared('DROP TRIGGER IF EXISTS tr_user_achievements');
    }
};
