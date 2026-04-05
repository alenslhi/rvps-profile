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
            Schema::create('portfolios', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('slug')->unique();
                $table->string('kategori'); // "Kegiatan Kampus", "Desain", "Web Dev"
                $table->text('deskripsi_singkat')->nullable();
                $table->json('galeri_foto')->nullable(); // Mendukung multiple upload
                $table->json('tools_digunakan')->nullable(); // Badge ikon
                $table->string('link_eksternal')->nullable(); // Link demo/repo jika ada
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
