<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\TeamMember;
use App\Models\University;
use App\Models\Gallery;
use App\Models\ContactMessage;
use App\Models\Post;
class PageController extends Controller
{
    public function tentangKami()
    {
        $teams = TeamMember::where('is_active', true)->orderBy('order')->get();
        $universities = University::where('is_active', true)->orderBy('order')->get();
        return view('pages.tentang-kami', compact('teams', 'universities'));
    }
    public function home()
    {
        // Ubah query Program menjadi sederhana, urutkan berdasarkan title
        $programs = Program::orderBy('title', 'asc')->get();
        
        // Tabel University tidak kita ubah, jadi biarkan seperti semula
        $universities = University::where('is_active', true)->orderBy('order')->get();

        return view('pages.home', compact('programs', 'universities'));
    }


    public function layanan()
    {
        // Ubah juga query Program di halaman layanan
        $programs = Program::orderBy('title', 'asc')->get();
        
        return view('pages.layanan', compact('programs'));
    }
    public function galeri()
    {
        $galleries = Gallery::where('is_active', true)->orderBy('order')->get();
        $categories = $galleries->pluck('category')->filter()->unique()->values();

        return view('pages.galeri', compact('galleries', 'categories'));
    }

    public function kontak()
    {
        // Mengambil semua program dan diurutkan berdasarkan abjad
        $programs = Program::orderBy('title', 'asc')->get();
        
        return view('pages.kontak', compact('programs'));
    }
   public function blog()
{
    $featured = Post::where('is_active', true)->where('is_featured', true)
        ->orderByDesc('published_at')->first();

    $posts = Post::where('is_active', true)
        ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
        ->orderByDesc('published_at')
        ->get();

    return view('pages.blog', compact('featured', 'posts'));
}

        public function blogShow($slug)
        {
            $post = Post::where('slug', $slug)->where('is_active', true)->firstOrFail();

            $related = Post::where('id', '!=', $post->id)
                ->where('is_active', true)
                ->where('category', $post->category)
                ->orderByDesc('published_at')
                ->take(3)
                ->get();

            if ($related->count() < 3) {
                $filler = Post::where('id', '!=', $post->id)
                    ->where('is_active', true)
                    ->whereNotIn('id', $related->pluck('id'))
                    ->orderByDesc('published_at')
                    ->take(3 - $related->count())
                    ->get();
                $related = $related->merge($filler);
            }

            return view('pages.blog-detail', compact('post', 'related'));
        }
    // Fungsi untuk memproses form kontak
    public function submitKontak(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'program_interest' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Pesan kamu berhasil dikirim! Tim kami akan segera menghubungi.');
    }
}