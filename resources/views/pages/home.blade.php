@extends('layouts.app')

@section('title', 'Bimbel Smart — Belajar Lebih Seru, Masa Depan Lebih Cemerlang')
@section('page', 'home')

@push('styles')
<style>
/* Token, reset, tombol, navbar dasar sudah ada di assets/style.css */

  /* ============ HERO ============ */
  .hero{
    background:linear-gradient(180deg,var(--blue-tint) 0%, #fff 78%);
    padding:80px 0 60px;overflow:hidden;
  }
  .hero .wrap{
    display:grid;grid-template-columns:1.05fr .95fr;gap:60px;align-items:center;
  }
  .hero-copy h1{font-size:clamp(36px,5vw,54px);margin-bottom:22px;}
  .hero-copy p.lead{font-size:17.5px;color:var(--ink-soft);max-width:480px;margin-bottom:34px;}
  .hero-actions{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:44px;}
  .hero-stats{display:flex;gap:34px;flex-wrap:wrap;}
  .hero-stats div{border-left:3px solid var(--gold);padding-left:14px;}
  .hero-stats strong{display:block;font-family:var(--font-display);font-size:26px;color:var(--blue);}
  .hero-stats span{font-size:13.5px;color:var(--ink-soft);}

  .hero-visual{position:relative;display:flex;justify-content:center;align-items:center;}
  .hero-blob{
    position:absolute;width:400px;height:400px;border-radius:46% 54% 60% 40%/50% 46% 54% 50%;
    background:linear-gradient(155deg,var(--blue),var(--blue-light));
    animation:blobmove 10s ease-in-out infinite;
  }
  @keyframes blobmove{
    0%,100%{border-radius:46% 54% 60% 40%/50% 46% 54% 50%;}
    50%{border-radius:58% 42% 45% 55%/45% 55% 45% 55%;}
  }
  .hero-photo{
    position:relative;z-index:1;width:340px;height:340px;object-fit:cover;
    border-radius:46% 54% 60% 40%/50% 46% 54% 50%;box-shadow:var(--shadow);
  }
  .hero-badge{
    position:absolute;top:14%;right:4%;background:var(--white);border-radius:var(--radius-sm);
    padding:12px 16px;box-shadow:var(--shadow);display:flex;align-items:center;gap:10px;font-weight:700;font-size:13.5px;
    animation:float 4s ease-in-out infinite;
  }
  .hero-badge2{
    position:absolute;bottom:10%;left:2%;background:var(--white);border-radius:var(--radius-sm);
    padding:12px 16px;box-shadow:var(--shadow);display:flex;align-items:center;gap:10px;font-weight:700;font-size:13.5px;
    animation:float 4s ease-in-out infinite;animation-delay:1.4s;
  }
  @keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
  .badge-dot{width:34px;height:34px;border-radius:50%;background:var(--blue-tint);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
  .badge-dot svg{width:17px;height:17px;color:var(--blue);}

  /* ============ WHY US ============ */
  .why{padding:100px 0;}
  .why .wrap{display:grid;grid-template-columns:.95fr 1.05fr;gap:70px;align-items:center;}
  .why-visual{position:relative;height:440px;}
  .why-img{
    position:absolute;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow);
  }
  .why-img.a{width:72%;height:78%;top:0;left:0;background:linear-gradient(150deg,#3E52C4,#141B4D);}
  .why-img.b{width:56%;height:52%;bottom:0;right:0;background:linear-gradient(150deg,#FFD877,#FFB703);border:6px solid #fff;}
  .why-img img{width:100%;height:100%;object-fit:cover;}

  .why-copy h2{font-size:clamp(28px,3.6vw,38px);margin-bottom:16px;}
  .why-copy > p{color:var(--ink-soft);margin-bottom:32px;max-width:500px;}
  .why-list{display:grid;gap:16px;}
  .why-item{
    display:flex;align-items:flex-start;gap:14px;background:var(--blue-tint);
    border-radius:var(--radius-sm);padding:16px 18px;
  }
  .why-check{
    width:30px;height:30px;border-radius:50%;background:var(--blue);flex-shrink:0;
    display:flex;align-items:center;justify-content:center;margin-top:2px;
  }
  .why-check svg{width:15px;height:15px;color:#fff;}
  .why-item p{font-weight:700;font-size:15.5px;color:var(--ink);}

  /* ============ PROGRAM ============ */
  .program{
    background:linear-gradient(165deg,var(--blue-deep),var(--blue));
    padding:100px 0;color:#fff;
  }
  .program .section-head p{color:rgba(255,255,255,.75);}
  .program .section-head h2{color:#fff;}
  .program-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
  .program-card{
    background:#fff;border-radius:var(--radius-lg);padding:36px 30px;color:var(--ink);
    position:relative;overflow:hidden;transition:transform .25s ease, box-shadow .25s ease;
    display:flex;flex-direction:column;
  }
  .program-card::before{
    content:'';position:absolute;top:0;right:0;width:0;height:0;
    border-style:solid;border-width:0 34px 34px 0;
    border-color:transparent var(--blue-tint) transparent transparent;
  }
  .program-card:hover{transform:translateY(-8px);box-shadow:0 26px 50px -20px rgba(0,0,0,.35);}
  .program-icon{
    width:58px;height:58px;border-radius:16px;background:var(--blue-tint);
    display:flex;align-items:center;justify-content:center;margin-bottom:22px;
  }
  .program-icon svg{width:28px;height:28px;color:var(--blue);}
  .program-card h3{font-size:21px;margin-bottom:10px;}
  .program-card p{
    color:var(--ink-soft);font-size:15px;margin-bottom:24px;
    flex-grow:1;
  }

  /* ============ PENGAJAR / LOGOS ============ */
  .teachers{padding:90px 0 100px;background:var(--white);}
  .teachers .section-head{margin-bottom:48px;}
  .logo-grid{
    display:grid;grid-template-columns:repeat(4,1fr);gap:18px;
  }
  .uni-badge{
    display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;
    background:var(--blue-tint);border-radius:var(--radius-md);padding:26px 14px;
    filter:grayscale(0);transition:transform .2s ease, background .2s ease;
    border:1px solid var(--line);
  }
  .uni-badge:hover{transform:translateY(-4px);background:#fff;box-shadow:var(--shadow);}
  .uni-badge .uni-mark{
    width:46px;height:46px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;
    box-shadow:inset 0 0 0 1.5px var(--line);overflow:hidden;
  }
  .uni-badge .uni-mark img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
  .uni-badge span{font-size:12.5px;font-weight:700;color:var(--ink-soft);text-align:center;}
  .logo-note{margin-top:18px;font-size:13px;color:var(--ink-soft);text-align:center;}

  /* ============ BLOG (ARTIKEL PILIHAN) ============ */
  .blog{padding:100px 0;background:var(--blue-tint);}
  .blog-head-row{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:20px;}
  .blog-head-row .section-head{margin-bottom:0;}
  .link-arrow{display:inline-flex;align-items:center;gap:6px;font-weight:700;color:var(--blue);font-size:14.5px;flex-shrink:0;}
  .link-arrow svg{width:15px;height:15px;transition:transform .2s;}
  .link-arrow:hover svg{transform:translateX(4px);}
  .blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
  .blog-card{
    background:#fff;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow);
    transition:transform .22s ease;position:relative;
  }
  .blog-card:hover{transform:translateY(-6px);}
  .blog-thumb{height:170px;position:relative;overflow:hidden;background:var(--blue-tint);}
  .blog-thumb::after{
    content:'';position:absolute;top:14px;right:0;width:0;height:0;z-index:2;
    border-style:solid;border-width:0 0 20px 20px;border-color:transparent transparent rgba(0,0,0,.12) transparent;
  }
  .blog-thumb img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
  .blog-tag{
    position:absolute;top:14px;left:14px;background:rgba(255,255,255,.92);color:var(--blue);
    font-size:11.5px;font-weight:800;padding:5px 12px;border-radius:100px;text-transform:uppercase;letter-spacing:.03em;
  }
  .blog-body{padding:24px;}
  .blog-date{font-size:12.5px;color:var(--ink-soft);margin-bottom:10px;display:block;}
  .blog-body h3{font-size:17.5px;margin-bottom:10px;line-height:1.35;}
  .blog-body p{font-size:14.5px;color:var(--ink-soft);margin-bottom:16px;}

  /* ============ GALERI ============ */
  .gallery{padding:100px 0;}
  .gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
  .gallery-item{
    position:relative;border-radius:var(--radius-md);overflow:hidden;height:220px;
    display:flex;align-items:flex-end;
  }
  .gallery-item img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .35s ease;}
  .gallery-item .tint{position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,27,77,0) 45%,rgba(10,14,40,.68));}
  .gallery-item .caption{
    position:relative;z-index:2;padding:18px;color:#fff;font-weight:700;font-size:14.5px;
  }
  .gallery-item:hover img{transform:scale(1.06);}

  /* ============ HUBUNGI KAMI ============ */
  .contact{padding:0 0 110px;}
  .contact-card{
    background:linear-gradient(155deg,var(--blue-tint),#fff);
    border-radius:var(--radius-lg);padding:56px;
    display:grid;grid-template-columns:.85fr 1.15fr;gap:56px;
    box-shadow:var(--shadow);border:1px solid var(--line);
  }
  .contact-info h2{font-size:clamp(24px,3vw,30px);margin-bottom:12px;}
  .contact-info > p{color:var(--ink-soft);margin-bottom:32px;}
  .contact-row{display:flex;gap:14px;margin-bottom:22px;align-items:flex-start;}
  .contact-row .ic{
    width:42px;height:42px;border-radius:12px;background:var(--blue);flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
  }
  .contact-row .ic svg{width:19px;height:19px;color:#fff;}
  .contact-row strong{display:block;font-size:14.5px;margin-bottom:3px;}
  .contact-row span{font-size:14px;color:var(--ink-soft);}
  .socials{display:flex;gap:10px;margin-top:8px;}
  .socials a{
    width:38px;height:38px;border-radius:50%;background:#fff;border:1px solid var(--line);
    display:flex;align-items:center;justify-content:center;transition:background .2s, transform .2s;
  }
  .socials a:hover{background:var(--gold);transform:translateY(-3px);}
  .socials a svg{width:17px;height:17px;color:var(--blue);}

  .contact-form{background:#fff;border-radius:var(--radius-md);padding:32px;box-shadow:var(--shadow);}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
  .field{display:flex;flex-direction:column;gap:8px;}
  .field.full{grid-column:1/-1;}
  .field label{font-size:13px;font-weight:700;color:var(--ink-soft);}
  .field input,.field textarea{
    border:1.5px solid var(--line);border-radius:12px;padding:13px 16px;font-family:inherit;font-size:14.5px;
    background:var(--blue-tint);transition:border-color .2s, background .2s;
  }
  .field input:focus,.field textarea:focus{outline:none;border-color:var(--blue);background:#fff;}
  .field textarea{resize:vertical;min-height:100px;}
  .form-status{font-size:13.5px;font-weight:700;color:var(--blue);height:18px;margin-top:4px;}

  @media (prefers-reduced-motion: reduce){
    html{scroll-behavior:auto;}
    .reveal{transition:none;opacity:1;transform:none;}
    .hero-blob,.hero-badge,.hero-badge2{animation:none;}
  }

  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .nav-links{display:none;}
    .burger{display:flex;}
    .nav-cta .btn-primary{display:none;}
    .hero .wrap{grid-template-columns:1fr;gap:48px;}
    .hero-visual{order:-1;height:320px;}
    .hero-blob{width:280px;height:280px;}
    .why .wrap{grid-template-columns:1fr;gap:40px;}
    .why-visual{height:340px;}
    .program-grid{grid-template-columns:repeat(2,1fr);} 
    .logo-grid{grid-template-columns:repeat(2,1fr);}
    .blog-grid{grid-template-columns:1fr;}
    .gallery-grid{grid-template-columns:repeat(2,1fr);}
    .contact-card{grid-template-columns:1fr;padding:32px;}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .form-row{grid-template-columns:1fr;}
  }
  @media (max-width:768px){
    .program-grid{grid-template-columns:1fr;} 
  }
  @media (max-width:560px){
    .hero-stats{gap:20px;}
    .contact-card{padding:24px;}
    .hero-badge,.hero-badge2{display:none;}
  }
</style>
@endpush

@section('content')
<!-- ============ HERO ============ -->
@if($hero)
<section class="hero" id="home">
  <div class="wrap">
    <div class="hero-copy reveal">
      <span class="eyebrow">{{ $hero->eyebrow }}</span>
      
      @php
          // Trik pintar: Mencari teks yang diapit tanda bintang (*) dan mengubahnya jadi stabilo kuning
          $titleText = $hero->title;
          $svgCount = 0;
          $formattedTitle = preg_replace_callback('/\*(.*?)\*/', function($matches) use (&$svgCount) {
              $svgCount++;
              // Menggunakan SVG pendek untuk kata pertama, SVG panjang untuk kata kedua
              $svg = $svgCount % 2 != 0 
                  ? '<svg viewBox="0 0 120 20" preserveAspectRatio="none"><path d="M2 14C20 6 45 4 60 8C80 13 100 6 118 10L118 18C90 20 60 20 30 18C18 17 8 16 2 18Z"/></svg>'
                  : '<svg viewBox="0 0 220 20" preserveAspectRatio="none"><path d="M2 14C40 6 90 4 120 8C160 13 200 6 218 10L218 18C170 20 110 20 60 18C34 17 14 16 2 18Z"/></svg>';
              
              return '<span class="hl gold">' . $matches[1] . $svg . '</span>';
          }, $titleText);
      @endphp
      
      <!-- Menampilkan judul yang sudah diformat secara dinamis -->
      <h1>{!! $formattedTitle !!}</h1>

      <p class="lead">{{ $hero->description }}</p>
      
      <div class="hero-actions">
        <a href="#kontak" class="btn btn-primary">Mulai Belajar</a>
        <a href="#program" class="btn btn-outline">Lihat Program</a>
      </div>
      
      <!-- DATA STATISTIK DINAMIS -->
      <div class="hero-stats">
        @foreach($stats as $stat)
          <div><strong>{{ $stat->value }}</strong><span>{{ $stat->label }}</span></div>
        @endforeach
      </div>
    </div>
    
    <div class="hero-visual reveal">
      <div class="hero-blob"></div>
      @if($hero->getFirstMediaUrl('hero_images'))
        <img class="hero-photo" src="{{ $hero->getFirstMediaUrl('hero_images') }}" alt="{{ $hero->title }}">
      @endif
    </div>
  </div>
</section>
@endif

<!-- ============ KENAPA PILIH BIMBEL SMART ============ -->
@if($whyUs)
<section class="why" id="kenapa">
  <div class="wrap">
    <div class="why-visual reveal">
      <div class="why-img a">
        @if($whyUs->getFirstMediaUrl('why_us_primary'))
          <img src="{{ $whyUs->getFirstMediaUrl('why_us_primary') }}" alt="Why Us Primary">
        @endif
      </div>
      <div class="why-img b">
        @if($whyUs->getFirstMediaUrl('why_us_secondary'))
          <img src="{{ $whyUs->getFirstMediaUrl('why_us_secondary') }}" alt="Why Us Secondary">
        @endif
      </div>
    </div>
    
    <div class="why-copy reveal">
      <span class="eyebrow">{{ $whyUs->eyebrow }}</span>
      <h2>{{ $whyUs->title }}</h2>
      <p>{{ $whyUs->description }}</p>
      
      <div class="why-list">
        @if($whyUs->points)
          @foreach($whyUs->points as $point)
            <div class="why-item">
              <span class="why-check">
                <svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </span>
              <p>{{ $point['point_text'] ?? '' }}</p>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ PROGRAM UNGGULAN ============ -->
<section class="program" id="program">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow" style="background:rgba(255,255,255,.12);color:#FFD877;">Program Kami</span>
      <h2>Program Unggulan Kami</h2>
      <p>Pilih jenjang pendidikan dan program bahasa yang sesuai dengan kebutuhan belajar Anda.</p>
    </div>
    
    <div class="program-grid reveal">
      <!-- LOOPING PROGRAM DINAMIS -->
      @forelse($programs as $program)
        <div class="program-card">
          <div class="program-icon">
            <!-- Menampilkan SVG dinamis dari Model -->
            {!! $program->icon !!}
          </div>
          <h3>{{ $program->name }}</h3>
          <p>{{ $program->description }}</p>
          <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
        </div>
      @empty
        <p style="color: #fff;">Belum ada program yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ PARA PENGAJAR ============ -->
<section class="teachers">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Tim Pengajar</span>
      <h2>Diajar oleh Lulusan Universitas Terbaik di Indonesia</h2>
      <p>Setiap tutor Bimbel Smart adalah lulusan kampus ternama, dipilih lewat proses seleksi ketat dan pelatihan mengajar berkelanjutan.</p>
    </div>
    <div class="logo-grid reveal">
      @forelse($universities as $uni)
        <div class="uni-badge">
          <span class="uni-mark">
            @if($uni->getFirstMediaUrl('university_logos'))
              <img src="{{ $uni->getFirstMediaUrl('university_logos') }}" alt="Logo {{ $uni->name }}">
            @else
              <img src="https://ui-avatars.com/api/?name={{ urlencode($uni->name) }}&background=EEF1FC&color=2C3E9E&bold=true&size=64" alt="Logo placeholder {{ $uni->name }}">
            @endif
          </span>
          <span>{{ $uni->name }}</span>
        </div>
      @empty
        <p>Belum ada universitas yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ BLOG & TIPS BELAJAR (ARTIKEL PILIHAN) ============ -->
@php
  $homeCategoryLabels = [
    'tips' => 'Tips Belajar',
    'info' => 'Info Pendidikan',
    'sukses' => 'Cerita Sukses',
    'english' => 'English Corner',
    'parenting' => 'Parenting',
  ];
@endphp
@if($featuredPosts->count())
<section class="blog" id="blog">
  <div class="wrap">
    <div class="blog-head-row reveal">
      <div class="section-head">
        <span class="eyebrow">Blog &amp; Tips Belajar</span>
        <h2>Dapatkan Tips Belajar Terbaru</h2>
        <p>Update seputar belajar efektif, info pendidikan, dan cerita seru dari teman-teman Bimbel Smart.</p>
      </div>
      <a href="{{ route('blog') }}" class="link-arrow">Lihat Semua Artikel <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
    <div class="blog-grid reveal">
      @foreach($featuredPosts as $item)
        <article class="blog-card">
          <div class="blog-thumb">
            <img src="{{ $item->getFirstMediaUrl('post_images') }}" alt="{{ $item->title }}">
            <span class="blog-tag">{{ $homeCategoryLabels[$item->category] ?? $item->category }}</span>
          </div>
          <div class="blog-body">
            <span class="blog-date">{{ $item->published_at?->translatedFormat('d M Y') }} &middot; {{ $item->read_time }} min baca</span>
            <h3>{{ $item->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($item->excerpt, 100) }}</p>
            <a href="{{ route('blog.show', $item->slug) }}" class="link-arrow">
              Baca Selengkapnya
              <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ============ GALERI ============ -->
@if($galleryItems->count())
<section class="gallery" id="galeri">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Galeri Kegiatan</span>
      <h2>Lihat Lebih Dekat Keseruan Belajar di Bimbel Smart</h2>
      <p>Momen-momen seru belajar dan keberhasilan siswa-siswi kami.</p>
    </div>
    <div class="gallery-grid reveal">
      @foreach($galleryItems as $item)
        <div class="gallery-item">
          <img src="{{ $item->getFirstMediaUrl('gallery_images', 'thumb') ?: $item->getFirstMediaUrl('gallery_images') }}" alt="Galeri Bimbel Smart">
          <div class="tint"></div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ============ HUBUNGI KAMI ============ -->
<section class="contact" id="kontak">
  <div class="wrap">
    <div class="contact-card reveal">
      <div class="contact-info">
        <span class="eyebrow">Hubungi Kami</span>
        <h2>Punya Pertanyaan? Jangan Ragu Bertanya</h2>
        <p>Tim kami siap membantu menjawab pertanyaan seputar program belajar kapan saja.</p>
        
        <!-- Email Kami Dinamis -->
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4V4z" stroke="currentColor" stroke-width="1.6"/><path d="M4 6l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Email Kami</strong><span>{{ $contactInfo->email ?? 'halo@bimbelsmart.id' }}</span></div>
        </div>
        
        <!-- Alamat Kantor Dinamis -->
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.1-7-11a7 7 0 1114 0c0 4.9-7 11-7 11z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.4" stroke="currentColor" stroke-width="1.6"/></svg></span>
          <div><strong>Kunjungi Kantor</strong><span>{{ $contactInfo->address ?? 'Menara Tendean Lantai 17 Unit C, Jalan Kapten Tendean No. 20C, Kelurahan: Kuningan Barat, Kecamatan: Mampang Prapatan, 12720' }}</span></div>
        </div>
        
        <!-- WhatsApp Admin Dinamis -->
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3.1-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.7a2 2 0 01-.5 2.1L8 9.7a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.5 2.7.6a2 2 0 011.7 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div>
            <strong>WhatsApp Admin</strong>
            <span>{!! nl2br(e($contactInfo->phone ?? "085881486381 (Admin Nawal)\n085814010671 (Admin Ayza)")) !!}</span>
          </div>
        </div>
        
        <div>
          <strong style="font-size:14.5px;display:block;margin-bottom:8px;">Ikuti Kami</strong>
          <div class="socials">
            <a href="https://www.instagram.com/bimbelsmart__/" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.6"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor"/></svg></a>
            <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3a3 3 0 00-3 3v2H9v3h2v6h3v-6h2.5l.5-3H14V9z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg></a>
            <a href="https://www.tiktok.com/@bimbelprivatsmart" aria-label="TikTok"><svg viewBox="0 0 24 24" fill="none"><path d="M14 4c.3 2 1.8 3.5 4 3.8v3c-1.5 0-2.9-.4-4-1.2v6.1a4.9 4.9 0 11-4.2-4.9v3.1a1.9 1.9 0 101.4 1.8V4h2.8z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg></a>
          </div>
        </div>
      </div>
      <form class="contact-form" method="POST" action="{{ route('kontak.submit') }}">
        @csrf
        <div class="form-row">
          <div class="field">
            <label for="name">Nama Lengkap</label>
            <input id="name" name="name" type="text" placeholder="Nama kamu" value="{{ old('name') }}" required>
          </div>
          <div class="field">
            <label for="phone">No. Telepon</label>
            <input id="phone" name="phone" type="tel" placeholder="08xx-xxxx-xxxx" value="{{ old('phone') }}" required>
          </div>
        </div>

        <div class="field full" style="margin-bottom:16px;">
          <label for="email">Alamat Email</label>
          <input id="email" name="email" type="email" placeholder="email@contoh.com" value="{{ old('email') }}">
        </div>

        <div class="field full" style="margin-bottom:16px;">
          <label for="message">Pesan Kamu</label>
          <textarea id="message" name="message" placeholder="Ceritakan kebutuhan belajarmu di sini..." required>{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Kirim Pesan Sekarang</button>

        <!-- Notifikasi Sukses dari Controller -->
        @if(session('success'))
          <p class="form-status" style="color: #1E7A3D; background: #EAF6EE; padding: 10px; border-radius: 8px; margin-top: 12px; font-weight: 600;">
            {{ session('success') }}
          </p>
        @endif
      </form>
    </div>
  </div>
</section>
@endsection

@push('scripts') 
@endpush