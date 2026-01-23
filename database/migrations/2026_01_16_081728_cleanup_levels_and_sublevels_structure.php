<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        // =========================
        // LEVELS: hapus course_id
        // =========================
        Schema::table('levels', function (Blueprint $table) {
            if (Schema::hasColumn('levels', 'course_id')) {
                $table->dropForeign(['course_id']);
                $table->dropColumn('course_id');
            }
        });

        // =========================
        // SUBLEVELS: hapus level_id
        // =========================
        Schema::table('sublevels', function (Blueprint $table) {
            if (Schema::hasColumn('sublevels', 'level_id')) {
                $table->dropForeign(['level_id']);
                $table->dropColumn('level_id');
            }
        });
    }

    public function down(): void
    {
        // =========================
        // LEVELS: balikin course_id
        // =========================
        Schema::table('levels', function (Blueprint $table) {
            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();
        });

        // =========================
        // SUBLEVELS: balikin level_id
        // =========================
        Schema::table('sublevels', function (Blueprint $table) {
            $table->foreignId('level_id')
                  ->constrained()
                  ->cascadeOnDelete();
        });
    }
};
