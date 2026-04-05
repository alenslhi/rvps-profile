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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('peran'); // misal: "System Information Student & Creative"
            $table->string('foto_profil')->nullable();
            $table->text('biodata_singkat')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable(); // Untuk @alenslhi
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('file_cv')->nullable(); // Untuk auto-download CV
            $table->json('riwayat_pendidikan')->nullable(); // Fleksibel untuk data kampus
            $table->json('pengalaman_organisasi')->nullable(); // Fleksibel untuk KSE, dll
            $table->json('keahlian_umum')->nullable(); // Untuk hybrid skills
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
