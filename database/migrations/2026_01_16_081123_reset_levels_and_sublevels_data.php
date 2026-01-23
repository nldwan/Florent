<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // matikan FK biar aman
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('levels')->truncate();
        DB::table('sublevels')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void
    {
        // kosongkan lagi (biar konsisten)
        DB::table('levels')->truncate();
        DB::table('sublevels')->truncate();
    }
};
