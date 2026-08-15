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
       Schema::create('layanan_banners', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable(); // <-- TAMBAHAN BARU
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('badge_1_text')->nullable(); 
            $table->string('badge_2_number')->nullable(); 
            $table->string('badge_2_text')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_banners');
    }
};
