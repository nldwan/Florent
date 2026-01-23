<?php

use App\Models\User;
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
        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->after('user_id')->constrained();
            $table->foreignId('level_id')->nullable()->after('course_id')->constrained();
            $table->foreignId('sublevel_id')->nullable()->after('level_id')->constrained();
            $table->integer('final_score')->nullable()->after('speaking_fluency')->nullable();
            $table->enum('status', ['completed', 'in_progress'])->after('final_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['level_id']);
            $table->dropForeign(['sublevel_id']);
            $table->dropColumn(['course_id', 'level_id', 'sublevel_id', 'final_score', 'status']);
        });
    }
};
