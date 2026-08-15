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
        Schema::create('why_us_sections', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable(); // Contoh: "KENAPA BIMBEL SMART"
            $table->string('title'); // Contoh: "Kenapa Pilih Bimbel Smart?"
            $table->text('description'); // Teks paragraf di bawah judul
            $table->json('points')->nullable(); // Menyimpan daftar keunggulan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_us_sections');
    }
};
