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
        Schema::create('pesanan_helm', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->string('nama_pelanggan')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('merk_helm')->nullable();
            $table->string('request_warna')->nullable();
            $table->integer('biaya')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('status_pengerjaan')->nullable();
            $table->string('foto_helm')->nullable();
            $table->timestamps();
        // tambahkan juga kolom lain kalau ada yang kurang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_helm');
    }
};
