<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_images', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel 'article' (diarahkan eksplisit karena nama tabelnya 'article', bukan 'articles')
            $table->foreignId('article_id')
                  ->constrained('article')
                  ->onDelete('cascade');

            // Path/nama file gambar
            $table->string('image_path');

            // created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_images');
    }
};
