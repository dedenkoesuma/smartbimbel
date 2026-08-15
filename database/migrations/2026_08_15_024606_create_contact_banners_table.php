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
        Schema::create('contact_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('stat_value')->nullable(); // Untuk teks "< 1 jam"
            $table->string('stat_label')->nullable(); // Untuk teks "Rata-rata respons"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_banners');
    }
};
