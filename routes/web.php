<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Rute Halaman Depan
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Tambahkan rute blog di sini:
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
// Rute Submit Form Kontak
Route::post('/kontak', [PageController::class, 'submitKontak'])->name('kontak.submit');

// Rute Login Filament
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');
//newsletter
Route::post('/newsletter', [App\Http\Controllers\PageController::class, 'submitNewsletter'])->name('newsletter.submit');