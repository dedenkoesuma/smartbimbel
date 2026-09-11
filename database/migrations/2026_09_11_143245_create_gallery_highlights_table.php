<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Untuk alt text atau judul gambar
            $table->string('image')->nullable(); // Path gambar (bisa dihapus jika pakai Spatie Media Library)
            $table->integer('position')->default(1); // Urutan 1-6
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_highlights');
    }
};