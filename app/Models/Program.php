<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order',
    ];

    // Accessor otomatis untuk icon sesuai nama program
    // Accessor otomatis untuk icon sesuai nama program
    public function getIconAttribute()
    {
        $name = strtolower($this->name);

        return match(true) {
            str_contains($name, 'preschool') => '<svg viewBox="0 0 24 24" fill="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            str_contains($name, 'sd') => '<svg viewBox="0 0 24 24" fill="none"><path d="M4 19.5V6a2 2 0 012-2h9a2 2 0 012 2v13.5M4 19.5h13M4 19.5a1.5 1.5 0 001.5 1.5H17M15 5v14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            str_contains($name, 'smp') => '<svg viewBox="0 0 24 24" fill="none"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            str_contains($name, 'sma') => '<svg viewBox="0 0 24 24" fill="none"><path d="M22 10L12 5 2 10l10 5 10-5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 12v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            str_contains($name, 'inggris') || str_contains($name, 'toefl') => '<svg viewBox="0 0 24 24" fill="none"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            // Tambahan untuk Kelas Online Reguler (Icon Layar)
            str_contains($name, 'reguler') => '<svg viewBox="0 0 24 24" fill="none"><rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            // Tambahan untuk Kelas Online Bahasa (Icon Globe)
            str_contains($name, 'online bahasa') => '<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><ellipse cx="12" cy="12" rx="4" ry="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="2" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            // Tambahan untuk Bahasa Mandarin (Icon Terjemahan)
            str_contains($name, 'mandarin') => '<svg viewBox="0 0 24 24" fill="none"><path d="M5 8l6 6M4 14l6-6 2-3M2 5h12M7 2h1M22 22l-5-10-5 10M14 18h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            // Default tetap icon plus (berjaga-jaga jika ada program baru yang belum didefinisikan)
            default => '<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="12" y1="8" x2="12" y2="16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="8" y1="12" x2="16" y2="12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        };
    }
}