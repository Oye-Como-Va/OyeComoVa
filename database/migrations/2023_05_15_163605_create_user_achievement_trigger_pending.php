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
        CREATE TRIGGER user_achievement_trigger_pending AFTER UPDATE ON users ' .
            ' FOR EACH ROW '.
            ' BEGIN ' .
                ' IF NEW.pending_tasks > 5 THEN '.
                    ' INSERT INTO achievement_user (user_id, achievement_id, created_at) VALUES (NEW.id, 4, NOW()); '.
                ' END IF; ' .
            ' END; '
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS user_achievement_trigger_pending');
    }
};
