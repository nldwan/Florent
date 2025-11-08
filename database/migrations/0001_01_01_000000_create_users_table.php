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

            // Data pendaftaran siswa
            $table->string('name'); // nama lengkap
            $table->string('email')->unique(); // email unik untuk login
            $table->string('kursus'); // kids / teen / toefl
            $table->string('no_hp'); // nomor HP

            // Login dan hak akses
            $table->string('password');
            $table->enum('role', ['admin', 'siswa'])->default('siswa');

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
