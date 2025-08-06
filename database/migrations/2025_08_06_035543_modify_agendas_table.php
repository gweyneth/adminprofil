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
        Schema::table('agendas', function (Blueprint $table) {
            // Ubah tipe kolom tanggal dari DATETIME menjadi DATE
            $table->date('tanggal_mulai')->change();
            $table->date('tanggal_selesai')->nullable()->change();

            // Tambahkan kolom baru untuk jam
            $table->time('jam_mulai')->after('tanggal_selesai');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            // Kembalikan perubahan jika di-rollback
            $table->dateTime('tanggal_mulai')->change();
            $table->dateTime('tanggal_selesai')->nullable()->change();
            $table->dropColumn(['jam_mulai', 'jam_selesai']);
        });
    }
};
