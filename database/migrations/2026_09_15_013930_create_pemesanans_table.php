<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration (membuat tabel).
     */
    public function up(): void
    {
        Schema::create('pemesanan_kamars', function (Blueprint $table) {
            $table->id(); // Primary key auto increment

            $table->string('nama_pemesan', 100); // Nama pemesan kamar
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin pemesan
            $table->char('nomor_identitas', 16); // Nomor identitas wajib 16 digit
            $table->enum('tipe_kamar', ['Standar', 'Deluxe', 'Executive']); // Tipe kamar yang dipesan
            $table->unsignedBigInteger('harga'); // Harga kamar sesuai tipe (dalam Rupiah)
            $table->date('tanggal_pesan'); // Tanggal pemesanan (disimpan format Y-m-d)
            $table->unsignedInteger('durasi_menginap'); // Lama menginap (dalam hari)
            $table->boolean('termasuk_breakfast')->default(false); // Status breakfast (true/false)
            $table->unsignedInteger('discount')->default(0); // Persentase discount yang berlaku (%)
            $table->unsignedBigInteger('total_bayar'); // Total bayar akhir setelah discount & breakfast

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Membatalkan migration (menghapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_kamars');
    }
};