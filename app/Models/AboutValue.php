<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description'
    ];

    // Accessor otomatis untuk icon sesuai judul (title)
    public function getIconAttribute()
    {
        $title = strtolower($this->title ?? '');

        return match(true) {
            str_contains($title, 'kualitas') => '<svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.9 6.9L22 9.5l-5.3 4.8L18 22l-6-3.6L6 22l1.3-7.7L2 9.5l7.1-.6L12 2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            
            str_contains($title, 'peduli') || str_contains($title, 'kepedulian') => '<svg viewBox="0 0 24 24" fill="none"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 000-7.8z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            
            str_contains($title, 'integritas') => '<svg viewBox="0 0 24 24" fill="none"><path d="M12 2l8 4v6c0 5-3.4 8.9-8 10-4.6-1.1-8-5-8-10V6l8-4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            
            str_contains($title, 'inovasi') => '<svg viewBox="0 0 24 24" fill="none"><path d="M9 18h6M10 22h4M12 2a6 6 0 00-4 10.5c.6.6 1 1.4 1 2.3V16h6v-1.2c0-.9.4-1.7 1-2.3A6 6 0 0012 2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            
            // Default icon (bulatan ceklis) jika admin memasukkan nilai yang berbeda
            default => '<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        };
    }
}