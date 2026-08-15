@extends('layouts.app')

@section('title', 'Layanan — Bimbel Smart')
@section('page', 'layanan')

@push('styles')
<style>
/* Token, reset, tombol, navbar & mobile-nav dasar sudah ada di assets/style.css */

  /* ============ PAGE BANNER ============ */
  .banner{padding:64px 0 80px;background:linear-gradient(180deg,#fff 0%,var(--blue-tint) 100%);overflow:hidden;}
  .banner-inner{display:grid;grid-template-columns:1.05fr .95fr;gap:60px;align-items:center;}
  .banner-copy{position:relative;}
  .banner-dots{
    position:absolute;top:-30px;left:-8px;width:76px;height:32px;
    background-image:radial-gradient(var(--blue) 2px, transparent 2px);
    background-size:12px 12px;opacity:.35;
  }
  .breadcrumb{display:flex;gap:8px;font-size:14px;color:var(--ink-soft);margin-bottom:24px;}
  .breadcrumb a{font-weight:600;color:var(--ink-soft);}
  .breadcrumb .current{font-weight:700;color:var(--gold-deep);}
  .banner-copy h1{font-size:clamp(30px,3.6vw,42px);color:var(--ink);max-width:480px;margin-bottom:16px;}
  .banner-copy p.lead{color:var(--ink-soft);max-width:440px;font-size:16px;margin-bottom:30px;}
  .banner-chips{display:flex;gap:10px;flex-wrap:wrap;}
  .banner-chips span{
    background:#fff;border:1.5px solid var(--line);color:var(--blue);font-weight:700;font-size:13px;
    padding:8px 16px;border-radius:100px;
  }

  .banner-visual{position:relative;height:400px;}
  .banner-shape{
    position:absolute;width:88%;height:88%;top:6%;left:10%;border-radius:var(--radius-lg);
    background:linear-gradient(150deg,var(--gold),var(--gold-deep));z-index:0;
  }
  .banner-photo{
    position:absolute;width:84%;height:84%;top:0;left:0;border-radius:var(--radius-lg);
    overflow:hidden;box-shadow:var(--shadow);z-index:1;
  }
  .banner-photo img{width:100%;height:100%;object-fit:cover;}
  .banner-stat{
    position:absolute;bottom:6%;right:0;background:#fff;border-radius:var(--radius-sm);
    padding:16px 22px;box-shadow:var(--shadow);text-align:center;z-index:2;
  }
  .banner-stat strong{display:block;font-family:var(--font-display);font-size:28px;color:var(--blue);}
  .banner-stat span{font-size:12.5px;color:var(--ink-soft);font-weight:600;}
  .banner-tag{
    position:absolute;top:6%;left:-4%;background:var(--blue-deep);color:#fff;border-radius:var(--radius-sm);
    padding:10px 18px;box-shadow:var(--shadow);font-weight:700;font-size:13px;z-index:2;
    display:flex;align-items:center;gap:8px;
  }
  .banner-tag svg{width:15px;height:15px;color:#FFD877;}

  /* ============ PROGRAM UTAMA ============ */
  .programs{padding:100px 0;}
  .program-list{display:grid;gap:26px;}
  .program-detail{
    display:grid;grid-template-columns:.42fr .58fr;gap:0;
    background:var(--blue-tint);border-radius:var(--radius-lg);overflow:hidden;
  }
  .program-detail:nth-child(even){grid-template-columns:.58fr .42fr;}
  .program-detail:nth-child(even) .pd-media{order:2;}
  .program-detail:nth-child(even) .pd-body{order:1;}
  .pd-media{position:relative;min-height:280px;}
  .pd-media img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
  .pd-badge{
    position:absolute;top:20px;left:20px;background:#fff;color:var(--blue);font-weight:800;
    font-family:var(--font-display);font-size:15px;padding:8px 16px;border-radius:100px;box-shadow:var(--shadow);
  }
  .pd-body{padding:44px 44px;}
  .pd-icon{
    width:54px;height:54px;border-radius:15px;background:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:18px;
  }
  .pd-icon svg{width:26px;height:26px;color:var(--blue);}
  .pd-body h3{font-size:24px;margin-bottom:6px;}
  .pd-tagline{font-size:14px;font-weight:700;color:var(--blue);margin-bottom:14px;}
  .pd-body > p.desc{color:var(--ink-soft);font-size:15px;margin-bottom:22px;}
  .pd-features{display:grid;grid-template-columns:1fr 1fr;gap:10px 18px;margin-bottom:26px;}
  .pd-features li{display:flex;gap:8px;align-items:flex-start;font-size:14px;color:var(--ink);font-weight:600;}
  .pd-features li svg{width:16px;height:16px;color:var(--blue);flex-shrink:0;margin-top:3px;}
  .pd-footer{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
  .pd-price strong{font-family:var(--font-display);font-size:22px;color:var(--blue);}
  .pd-price span{display:block;font-size:12px;color:var(--ink-soft);}

  /* ============ LAYANAN TAMBAHAN ============ */
  .addons{padding:100px 0;background:var(--blue-tint);}
  .addons-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;}
  .addon-card{
    background:#fff;border-radius:var(--radius-md);padding:30px 26px;box-shadow:var(--shadow);
    transition:transform .22s ease;position:relative;overflow:hidden;
  }
  .addon-card::before{
    content:'';position:absolute;top:0;right:0;width:0;height:0;
    border-style:solid;border-width:0 30px 30px 0;
    border-color:transparent var(--blue-tint) transparent transparent;
  }
  .addon-card:hover{transform:translateY(-6px);}
  .addon-icon{
    width:52px;height:52px;border-radius:14px;background:var(--blue-tint);display:flex;align-items:center;justify-content:center;margin-bottom:18px;
  }
  .addon-icon svg{width:24px;height:24px;color:var(--blue);}
  .addon-card h4{font-size:17px;margin-bottom:6px;}
  .addon-card p{font-size:14px;color:var(--ink-soft);}

  /* ============ CARA KERJA ============ */
  .steps{padding:100px 0;}
  .steps-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0;position:relative;}
  .step-item{position:relative;padding:0 20px;text-align:center;}
  .step-item:not(:last-child)::after{
    content:'';position:absolute;top:30px;left:60%;width:80%;height:2px;
    background:repeating-linear-gradient(90deg,var(--line) 0 8px,transparent 8px 16px);
  }
  .step-num{
    width:60px;height:60px;border-radius:50%;background:linear-gradient(150deg,var(--blue-light),var(--blue-deep));
    color:#fff;font-family:var(--font-display);font-size:22px;font-weight:700;
    display:flex;align-items:center;justify-content:center;margin:0 auto 20px;position:relative;z-index:1;
  }
  .step-item h4{font-size:16.5px;margin-bottom:8px;}
  .step-item p{font-size:13.5px;color:var(--ink-soft);}

  /* ============ FAQ ============ */
  .faq{padding:100px 0;background:var(--blue-tint);}
  .faq-list{max-width:820px;margin:0 auto;display:grid;gap:14px;}
  .faq-item{background:#fff;border-radius:var(--radius-sm);box-shadow:var(--shadow);overflow:hidden;}
  .faq-q{
    width:100%;display:flex;align-items:center;justify-content:space-between;gap:16px;
    padding:22px 26px;text-align:left;font-weight:700;font-size:15.5px;color:var(--ink);
  }
  .faq-q .plus{
    width:28px;height:28px;border-radius:50%;background:var(--blue-tint);flex-shrink:0;
    display:flex;align-items:center;justify-content:center;transition:transform .25s ease, background .25s ease;
  }
  .faq-q .plus svg{width:14px;height:14px;color:var(--blue);}
  .faq-item.open .faq-q .plus{background:var(--gold);transform:rotate(135deg);}
  .faq-item.open .faq-q .plus svg{color:var(--blue-deep);}
  .faq-a{max-height:0;overflow:hidden;transition:max-height .3s ease;}
  .faq-a p{padding:0 26px 22px;font-size:14.5px;color:var(--ink-soft);max-width:640px;}

  /* ============ CTA ============ */
  .cta{padding:0 0 110px;}
  .cta-card{
    background:linear-gradient(155deg,var(--blue-deep),var(--blue));
    border-radius:var(--radius-lg);padding:64px;text-align:center;color:#fff;
    position:relative;overflow:hidden;
  }
  .cta-card::before{
    content:'';position:absolute;width:320px;height:320px;border-radius:50%;
    background:rgba(255,183,3,.14);top:-140px;right:-80px;
  }
  .cta-card h2{color:#fff;font-size:clamp(26px,3.4vw,36px);margin-bottom:14px;position:relative;}
  .cta-card p{color:rgba(255,255,255,.8);max-width:520px;margin:0 auto 30px;position:relative;}
  .cta-actions{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;position:relative;}

  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .nav-links{display:none;}
    .burger{display:flex;}
    .nav-cta .btn-primary{display:none;}
    .banner-inner{grid-template-columns:1fr;gap:44px;}
    .banner-copy{order:2;}
    .banner-dots{display:none;}
    .banner-visual{order:1;height:280px;}
    .banner-tag{left:0;top:4%;}
    .banner-stat{bottom:4%;right:2%;padding:10px 16px;}

    .program-detail,
    .program-detail:nth-child(even){grid-template-columns:1fr;}
    .program-detail:nth-child(even) .pd-media{order:1;}
    .program-detail:nth-child(even) .pd-body{order:2;}
    .pd-media{min-height:220px;}
    .pd-body{padding:32px 26px;}
    .pd-features{grid-template-columns:1fr;}

    .addons-grid{grid-template-columns:1fr 1fr;}
    .steps-grid{grid-template-columns:1fr 1fr;gap:36px 0;}
    .step-item::after{display:none;}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .cta-card{padding:40px 28px;}
  }
  @media (max-width:560px){
    .banner{padding:44px 0 50px;}
    .banner-tag{display:none;}
    .addons-grid{grid-template-columns:1fr;}
    .steps-grid{grid-template-columns:1fr;}
    .pd-footer{align-items:flex-start;}
  }
</style>
@endpush

@section('content')

<!-- ============ PAGE BANNER ============ -->
@if($banner)
<section class="banner">
  <div class="wrap">
    <div class="banner-inner">
      <div class="banner-copy reveal">
        <div class="banner-dots"></div>
        <div class="breadcrumb"><a href="{{ route('home') }}#home">Home</a><span>/</span><span class="current">Layanan</span></div>
        <span class="eyebrow">{{ $banner->eyebrow }}</span>
        <h1>{{ $banner->title }}</h1>
        <p class="lead">{{ $banner->description }}</p>
        <div class="banner-chips">
          @foreach($programs as $prog)
            @if($prog->badge)
              <span>{{ $prog->badge }}</span>
            @endif
          @endforeach
        </div>
      </div>
      <div class="banner-visual reveal">
        <div class="banner-shape"></div>
        <div class="banner-photo">
          @if($banner->getFirstMediaUrl('layanan_banner'))
            <img src="{{ $banner->getFirstMediaUrl('layanan_banner') }}" alt="{{ $banner->title }}">
          @else
            <img src="https://images.pexels.com/photos/8926900/pexels-photo-8926900.jpeg?auto=compress&cs=tinysrgb&w=900" alt="Banner Layanan">
          @endif
        </div>
        @if($banner->badge_1_text)
        <div class="banner-tag">
          <svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          {{ $banner->badge_1_text }}
        </div>
        @endif
        @if($banner->badge_2_number)
        <div class="banner-stat">
          <strong>{{ $banner->badge_2_number }}</strong>
          <span>{{ $banner->badge_2_text }}</span>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ PROGRAM UTAMA ============ -->
<section class="programs" id="program-utama">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Program Utama</span>
      <h2>Pilih Program Sesuai Jenjang</h2>
      <p>Kurikulum disusun bertahap agar anak benar-benar memahami konsep, bukan sekadar menghafal.</p>
    </div>
    <div class="program-list">
      @forelse($programs as $program)
      <div class="program-detail reveal">
        <div class="pd-media">
          @if($program->getFirstMediaUrl('layanan_program'))
            <img src="{{ $program->getFirstMediaUrl('layanan_program') }}" alt="{{ $program->title }}">
          @else
            <img src="https://images.pexels.com/photos/5621944/pexels-photo-5621944.jpeg?auto=compress&cs=tinysrgb&w=700" alt="Placeholder Program">
          @endif
          @if($program->badge)
            <span class="pd-badge">{{ $program->badge }}</span>
          @endif
        </div>
        <div class="pd-body">
          <div class="pd-icon">
            <svg viewBox="0 0 24 24" fill="none"><path d="M4 19.5V6a2 2 0 012-2h9a2 2 0 012 2v13.5M4 19.5h13M4 19.5a1.5 1.5 0 001.5 1.5H17M15 5v14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <h3>{{ $program->title }}</h3>
          @if($program->subtitle)
            <p class="pd-tagline">{{ $program->subtitle }}</p>
          @endif
          <p class="desc">{{ $program->description }}</p>
          
          @if($program->checklists)
          <ul class="pd-features">
            @foreach($program->checklists as $item)
              <li><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>{{ $item['point'] ?? '' }}</li>
            @endforeach
          </ul>
          @endif

          <div class="pd-footer">
            <div class="pd-price"><strong>Konsultasi</strong><span>hubungi kami untuk info biaya</span></div>
            <a href="{{ route('kontak') }}#form-kontak" class="btn btn-outline btn-sm">Konsultasi Program Ini</a>
          </div>
        </div>
      </div>
      @empty
        <p>Belum ada program utama yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ LAYANAN TAMBAHAN ============ -->
<section class="addons">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Layanan Tambahan</span>
      <h2>Dukungan Belajar Lainnya</h2>
      <p>Selain program utama, kami juga menyediakan layanan pendukung sesuai kebutuhan spesifik siswa.</p>
    </div>
    <div class="addons-grid reveal">
      @forelse($additionals as $addon)
      <div class="addon-card">
        <div class="addon-icon">
          {!! $addon->icon !!}
        </div>
        <h4>{{ $addon->title }}</h4>
        <p>{{ $addon->description }}</p>
      </div>
      @empty
        <p>Belum ada layanan tambahan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ CARA KERJA ============ -->
<section class="steps">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Cara Bergabung</span>
      <h2>Mulai Belajar Hanya dalam 4 Langkah</h2>
      <p>Proses pendaftaran yang simpel, tanpa ribet.</p>
    </div>
    <div class="steps-grid reveal">
      @forelse($steps as $step)
      <div class="step-item">
        <div class="step-num">{{ $step->step_number }}</div>
        <h4>{{ $step->title }}</h4>
        <p>{{ $step->description }}</p>
      </div>
      @empty
        <p>Belum ada data langkah bergabung.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="faq">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">FAQ</span>
      <h2>Pertanyaan yang Sering Ditanyakan</h2>
      <p>Masih ragu? Mudah-mudahan jawabannya ada di sini.</p>
    </div>
    <div class="faq-list reveal">
      @forelse($faqs as $faq)
      <div class="faq-item">
        <button class="faq-q">{{ $faq->question }}<span class="plus"><svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg></span></button>
        <div class="faq-a"><p>{{ $faq->answer }}</p></div>
      </div>
      @empty
        <p>Belum ada pertanyaan FAQ.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Siap Bantu Anak Anda Belajar Lebih Percaya Diri?</h2>
      <p>Konsultasikan kebutuhan belajarnya sekarang, gratis dan tanpa komitmen.</p>
      <div class="cta-actions">
        <a href="{{ route('kontak') }}#form-kontak" class="btn btn-primary">Konsultasi Gratis</a>
        <a href="{{ route('tentang-kami') }}" class="btn btn-outline-light">Kenali Kami Lebih Jauh</a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
// FAQ accordion
  document.querySelectorAll('.faq-item').forEach(item => {
    const q = item.querySelector('.faq-q');
    const a = item.querySelector('.faq-a');
    q.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach(openItem => {
        if (openItem !== item) {
          openItem.classList.remove('open');
          openItem.querySelector('.faq-a').style.maxHeight = null;
        }
      });
      if (isOpen) {
        item.classList.remove('open');
        a.style.maxHeight = null;
      } else {
        item.classList.add('open');
        a.style.maxHeight = a.scrollHeight + 'px';
      }
    });
  });
</script>
@endpush