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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // relasi ke siswa

            // Speaking
            $table->integer('speaking_pronouncing')->nullable();
            $table->integer('speaking_intonation')->nullable();
            $table->integer('speaking_fluency')->nullable();

            // Writing
            $table->integer('writing_grammar')->nullable();
            $table->integer('writing_reading')->nullable();
            $table->integer('writing_listening')->nullable();
            $table->integer('writing_vocabulary')->nullable();
            $table->integer('writing_translation')->nullable();
            $table->integer('writing_composition')->nullable();

            // Catatan dari guru
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
