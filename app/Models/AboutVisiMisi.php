<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutVisiMisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'visi_title',
        'visi_description',
        'misi_title',
        'misi_points',
    ];

    protected $casts = [
        'misi_points' => 'array',
    ];

    // Accessor otomatis untuk Icon Visi (Icon Mata)
    public function getVisiIconAttribute()
    {
        $title = strtolower($this->visi_title ?? '');

        return match(true) {
            str_contains($title, 'visi') => '<svg viewBox="0 0 24 24" fill="none"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.7"/></svg>',
            default => '<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="3" fill="currentColor"/></svg>',
        };
    }

    // Accessor otomatis untuk Icon Misi (Icon Target/Sasaran)
    public function getMisiIconAttribute()
    {
        $title = strtolower($this->misi_title ?? '');

        return match(true) {
            str_contains($title, 'misi') => '<svg viewBox="0 0 24 24" fill="none"><path d="M9 11l3 3L22 4M12 21a9 9 0 100-18 9 9 0 000 18z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            default => '<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.6"/><path d="M12 8v4l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
        };
    }

    // Accessor untuk Icon Ceklis kecil di daftar poin misi
    public function getCheckIconAttribute()
    {
        return '<svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    }
}