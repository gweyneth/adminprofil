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
        Schema::table('gurus', function (Blueprint $table) {
            // Mengubah nama kolom 'nip' menjadi 'nuptk'
            $table->renameColumn('nip', 'nuptk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Mengembalikan nama kolom jika di-rollback
            $table->renameColumn('nuptk', 'nip');
        });
    }
};
