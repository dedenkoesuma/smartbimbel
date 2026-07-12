<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Bimbel Smart
|--------------------------------------------------------------------------
| Copy isi file ini ke routes/web.php di project Laravel kamu
| (atau require dari sana kalau mau dipisah).
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tentang-kami', function () {
    return view('pages.tentang-kami');
})->name('tentang-kami');

Route::get('/layanan', function () {
    return view('pages.layanan');
})->name('layanan');

Route::get('/galeri', function () {
    return view('pages.galeri');
})->name('galeri');

Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

Route::post('/kontak', function () {
    // TODO: ganti closure ini dengan controller (mis. ContactController@store)
    // buat validasi input dan simpan/kirim pesan dari form kontak.
    return back()->with('success', 'Pesan terkirim! Tim kami akan menghubungi kamu segera.');
})->name('kontak.store');
Route::get('/blog/{slug}', function ($slug) {
    return view('pages.blog-detail', ['slug' => $slug]);
})->name('blog.show');