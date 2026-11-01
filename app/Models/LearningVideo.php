<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LearningVideo extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'grade_level',
        'tutor_name',
        'description',
        'video_source',
        'youtube_url',
        'duration',
        'published_at',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (LearningVideo $video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title) . '-' . Str::lower(Str::random(4));
            }
        });
    }

    /**
     * Ekstrak 11-karakter YouTube ID dari berbagai format link YouTube.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        if (empty($this->youtube_url)) {
            return null;
        }

        $url = trim($this->youtube_url);

        // Jika admin langsung memasukkan 11 karakter ID
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // Cocokkan format watch?v=, youtu.be/, embed/, shorts/, live/
        $pattern = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?|shorts|live)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * URL Embed YouTube untuk iframe modal player.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->video_source === 'youtube' && $this->youtube_id) {
            return 'https://www.youtube.com/embed/' . $this->youtube_id . '?autoplay=1&rel=0';
        }

        return null;
    }

    /**
     * URL file video hasil upload langsung (MP4/WebM).
     */
    public function getVideoFileUrlAttribute(): ?string
    {
        if ($this->video_source === 'upload') {
            return $this->getFirstMediaUrl('video_file') ?: null;
        }

        return null;
    }

    /**
     * URL Thumbnail prioritas:
     * 1. Gambar custom yang diupload di koleksi 'video_thumbnail'
     * 2. Thumbnail otomatis dari YouTube jika sumbernya YouTube
     * 3. Gambar fallback edukasi
     */
    public function getThumbnailUrlAttribute(): string
    {
        $customThumb = $this->getFirstMediaUrl('video_thumbnail');
        if (!empty($customThumb)) {
            return $customThumb;
        }

        if ($this->video_source === 'youtube' && $this->youtube_id) {
            return 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg';
        }

        return 'https://images.pexels.com/photos/4145153/pexels-photo-4145153.jpeg?auto=compress&cs=tinysrgb&w=800';
    }
}
