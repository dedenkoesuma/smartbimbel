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
        Schema::create('learning_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('grade_level')->nullable();
            $table->string('tutor_name')->nullable();
            $table->text('description')->nullable();
            $table->string('video_source')->default('youtube'); // 'youtube' | 'upload'
            $table->string('youtube_url')->nullable();
            $table->string('duration')->nullable();
            $table->date('published_at')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_videos');
    }
};
