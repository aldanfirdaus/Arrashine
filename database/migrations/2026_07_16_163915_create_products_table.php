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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama produk (misal: "Soul & Spirit")
            $table->text('description');        // Deskripsi lengkap parfum
            $table->string('top_notes');        // Aroma atas (misal: "Bergamot, Pear")
            $table->string('middle_notes');     // Aroma tengah (misal: "Jasmine, Orange Blossom")
            $table->string('base_notes');       // Aroma dasar (misal: "Vanilla, Patchouli")
            $table->enum('gender',['Man','Women','Unisex']);
            $table->decimal('price', 12, 2);    // Harga (mendukung angka desimal, misal: 150000.00)
            $table->string('image');            // Nama file gambar produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
