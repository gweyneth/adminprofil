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
        Schema::table('organigrams', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom 'id'
            $table->string('nama_organigram')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organigrams', function (Blueprint $table) {
            $table->dropColumn('nama_organigram');
        });
    }
};
