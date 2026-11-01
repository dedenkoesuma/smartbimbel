<?php

namespace Database\Seeders;

use App\Models\LearningVideo;
use Illuminate\Database\Seeder;

class LearningVideoSeeder extends Seeder
{
    public function run(): void
    {
        if (LearningVideo::count() > 0) {
            return;
        }

        $videos = [
            [
                'title' => 'Trik Cepat Penalaran Matematika UTBK SNBT — Pembahasan Soal Perbandingan & Aritmatika Sosial',
                'slug' => 'trik-cepat-penalaran-matematika-utbk-snbt-perbandingan',
                'category' => 'UTBK & SNBT',
                'grade_level' => 'UTBK & SNBT',
                'tutor_name' => 'Kak Raka — Tutor Matematika',
                'description' => "Pembahasan soal asli tipe Penalaran Matematika UTBK SNBT.\nDi potongan video ini, kita membahas cara menerjemahkan soal cerita panjang menjadi model matematika sederhana yang bisa diselesaikan dalam waktu kurang dari 45 detik.",
                'video_source' => 'youtube',
                'youtube_url' => 'https://www.youtube.com/watch?v=aircAruvnKk',
                'duration' => '06:45',
                'published_at' => now()->subDays(1),
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Pembahasan Soal Fisika SMA Kelas 11 — Hukum Newton & Dinamika Partikel Tanpa Hafal Rumus',
                'slug' => 'pembahasan-soal-fisika-sma-hukum-newton',
                'category' => 'Fisika',
                'grade_level' => 'SMA',
                'tutor_name' => 'Kak Dimas — Tutor Fisika',
                'description' => 'Masih sering bingung menguraikan gaya pada bidang miring dan sistem katrol? Yuk simak potongan pembahasan soal Fisika SMA berikut menggunakan metode diagram benda bebas.',
                'video_source' => 'youtube',
                'youtube_url' => 'https://www.youtube.com/watch?v=ZM8ECpBuQYE',
                'duration' => '05:20',
                'published_at' => now()->subDays(3),
                'order' => 2,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Kupas Tuntas Soal Persamaan Kuadrat & Fungsi — Matematika SMP Kelas 9',
                'slug' => 'kupas-tuntas-soal-persamaan-kuadrat-smp',
                'category' => 'Matematika',
                'grade_level' => 'SMP',
                'tutor_name' => 'Kak Nisa — Tutor Matematika',
                'description' => 'Cara menentukan akar-akar persamaan kuadrat dan menyusun persamaan kuadrat baru dengan cepat untuk persiapan ujian sekolah SMP.',
                'video_source' => 'youtube',
                'youtube_url' => 'https://www.youtube.com/watch?v=fNk_zzaMoSs',
                'duration' => '04:50',
                'published_at' => now()->subDays(5),
                'order' => 3,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Strategi Menjawab Soal Reading Comprehension & Main Idea — Literasi Bahasa Inggris',
                'slug' => 'strategi-reading-comprehension-literasi-bahasa-inggris',
                'category' => 'Bahasa Inggris',
                'grade_level' => 'UTBK & SNBT',
                'tutor_name' => 'Ms. Clara — Tutor English',
                'description' => 'Tips skimming dan scanning teks panjang Bahasa Inggris agar tidak kehabisan waktu saat mengerjakan soal Main Idea dan Inference.',
                'video_source' => 'youtube',
                'youtube_url' => 'https://www.youtube.com/watch?v=WUvTyaaNkzM',
                'duration' => '07:15',
                'published_at' => now()->subDays(7),
                'order' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($videos as $data) {
            LearningVideo::create($data);
        }
    }
}
