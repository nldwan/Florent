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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // relasi ke user (siswa)
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // ID transaksi midtrans
            $table->string('order_id')->unique();

            // pembayaran untuk bulan apa
            $table->string('month'); // contoh: 2026-01

            // jumlah bayar
            $table->integer('amount');

            // status pembayaran
            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'expired'
            ])->default('pending');

            // metode pembayaran (gopay, bank, dll)
            $table->string('payment_method')->nullable();

            // waktu berhasil bayar
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
