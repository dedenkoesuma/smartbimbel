<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia; 
use Spatie\MediaLibrary\InteractsWithMedia; 

class GalleryHighlight extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia; // <-- Tambahkan InteractsWithMedia di sini

    protected $fillable = [
        'title',
        'position',
        'is_active'
    ];
}