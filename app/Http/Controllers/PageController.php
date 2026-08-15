<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\TeamMember;
use App\Models\University;
use App\Models\Gallery;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\HeroSection;
use App\Models\WhyUsSection;
use App\Models\Stat;
use App\Models\AboutBanner;
use App\Models\AboutStory;
use App\Models\AboutVisiMisi;
use App\Models\AboutValue;
use App\Models\Testimonial;
use App\Models\LayananBanner;
use App\Models\LayananProgram;
use App\Models\AdditionalService;
use App\Models\JoinStep;
use App\Models\Faq;
use App\Models\ContactBanner;
use App\Models\NewsletterSubscriber;

class PageController extends Controller
{
    public function tentangKami()
    {
        // 1. Ambil data singleton (hanya 1 baris)
        $banner = AboutBanner::first();
        $story = AboutStory::first();
        $visiMisi = AboutVisiMisi::first();
        
        // 2. Ambil data jamak (banyak baris)
        $values = AboutValue::all();
        $testimonials = Testimonial::all();
        
        // 3. Ambil data dari tabel yang sudah ada sebelumnya
        $teams = TeamMember::where('is_active', true)->orderBy('order')->get();
        $stats = Stat::orderBy('id', 'asc')->take(4)->get(); // Ambil 4 stat untuk halaman ini

        return view('pages.tentang-kami', compact(
            'banner', 'story', 'visiMisi', 'values', 'testimonials', 'teams', 'stats'
        ));
    }

    public function home()
    {
        // 1. Ambil data Hero & Stats (Dibatasi maksimal 3)
        $hero = HeroSection::where('is_active', true)->first();
        $stats = Stat::orderBy('id', 'asc')->take(3)->get(); // Tambahkan ->take(3) di sini

        // 2. Ambil data Why Us (Kenapa Pilih Kami)
        $whyUs = WhyUsSection::first();

        // 3. Ambil data Program
        $programs = Program::orderBy('order', 'asc')->get();
        
        $universities = University::where('is_active', true)->orderBy('order')->get();

        $featuredPosts = Post::where('is_active', true)
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('pages.home', compact('hero', 'stats', 'whyUs', 'programs', 'universities', 'featuredPosts'));
    }

    public function layanan()
    {
        $banner = LayananBanner::first();
        $programs = LayananProgram::all();
        $additionals = AdditionalService::all();
        $steps = JoinStep::orderBy('step_number', 'asc')->get();
        $faqs = Faq::all();

        return view('pages.layanan', compact('banner', 'programs', 'additionals', 'steps', 'faqs'));
    }

    public function galeri()
    {
        $galleries = Gallery::where('is_active', true)->orderBy('order')->get();
        $categories = $galleries->pluck('category')->filter()->unique()->values();

        return view('pages.galeri', compact('galleries', 'categories'));
    }

    public function kontak()
    {
        $banner = ContactBanner::first(); // Panggil data banner kontak
        $programs = Program::orderBy('order', 'asc')->get();
        $faqs = Faq::all();

        return view('pages.kontak', compact('banner', 'programs', 'faqs'));
    }

    public function blog()
    {
        $featured = Post::where('is_active', true)->where('is_featured', true)
            ->orderByDesc('published_at')->first();

        $posts = Post::where('is_active', true)
            ->when($featured, fn ($q) => $q->where('id', '!=', $featured->id))
            ->orderByDesc('published_at')
            ->get();

        // Mengambil kategori unik dari database secara dinamis
        $categories = Post::where('is_active', true)
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view('pages.blog', compact('featured', 'posts', 'categories'));
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
    public function submitNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:newsletter_subscribers,email',
        ], [
            'email.unique' => 'Email ini sudah terdaftar di newsletter kami.',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('newsletter_success', 'Terima kasih telah berlangganan newsletter kami!');
    }
}