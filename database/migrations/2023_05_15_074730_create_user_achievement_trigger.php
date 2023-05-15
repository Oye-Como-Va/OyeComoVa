<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
             CREATE TRIGGER user_achievement_trigger_working ' .
            ' AFTER UPDATE ON users ' .
            ' FOR EACH ROW ' .
            ' BEGIN '.
                'IF (SELECT COUNT(*) FROM working_areas WHERE user_id = NEW.id AND end_time_real > end_time) > 0 THEN '.
                    ' INSERT INTO achievement_user (user_id, achievement_id, created_at) '.
                    ' VALUES (NEW.id, 3, NOW());' .
                ' END IF; '.
            ' END '
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS user_achievement_trigger');
    }
};
