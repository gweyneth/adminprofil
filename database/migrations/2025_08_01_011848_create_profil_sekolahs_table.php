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
        Schema::create('profil_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 100);
            $table->string('npsn', 20)->nullable();
            $table->text('alamat');
            $table->string('no_telp', 20);
            $table->string('email', 100);
            $table->text('sejarah');
            $table->text('visi');
            $table->text('misi');
            $table->string('logo', 255)->nullable();
            
            // Kolom tambahan sesuai permintaan
            $table->text('maps')->nullable(); // Untuk menyimpan embed code Google Maps
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_sekolahs');
    }
};
