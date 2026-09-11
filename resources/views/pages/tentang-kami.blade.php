@extends('layouts.app')

@section('title', 'Tentang Kami — Bimbel Smart')
@section('page', 'tentang')

@push('styles')
<style>
/* Token, reset, tombol, navbar & mobile-nav dasar sudah ada di assets/style.css */

  /* ============ PAGE BANNER ============ */
  .banner{
    background:#fff;overflow:hidden;
  }
  .banner-inner{
    display:grid;grid-template-columns:1fr .95fr;min-height:460px;
  }
  .banner-copy{
    background:linear-gradient(155deg,var(--blue-deep),var(--blue));
    color:#fff;display:flex;flex-direction:column;justify-content:center;
    padding:70px 60px 70px 5vw;position:relative;
  }
  .banner-dots{
    position:absolute;top:36px;left:5vw;width:76px;height:32px;
    background-image:radial-gradient(rgba(255,255,255,.35) 2px, transparent 2px);
    background-size:12px 12px;
  }
  .breadcrumb{display:flex;gap:8px;font-size:14px;color:rgba(255,255,255,.55);margin-bottom:26px;}
  .breadcrumb a{font-weight:600;color:rgba(255,255,255,.65);}
  .breadcrumb .current{font-weight:700;color:#FFD877;}
  .banner-copy .eyebrow{background:rgba(255,255,255,.14);color:#FFD877;}
  .banner-copy h1{font-size:clamp(30px,3.6vw,42px);color:#fff;max-width:460px;margin-bottom:16px;}

  /* FIX BANNER LEAD TEXT */
  .banner-copy .lead-text{
    position:relative;
    max-height:110px; /* Muat sekitar 3-4 baris ringkas */
    overflow:hidden;
    transition:max-height .45s ease;
    color:rgba(255,255,255,.85);
    max-width:460px;
    font-size:16px;
    line-height:1.6;
    margin-top:4px;
    /* Pake mask-image biar fade mulus tanpa merusak gradient background */
    -webkit-mask-image: linear-gradient(180deg, #000 50%, transparent 100%);
    mask-image: linear-gradient(180deg, #000 50%, transparent 100%);
  }
  .banner-copy .lead-text.expanded{ 
    max-height:2000px;
    -webkit-mask-image: none;
    mask-image: none;
  }

  .banner-toggle{
    margin-top:14px;
    background:none;
    border:none;
    padding:0;
    color:#FFD877;
    font-weight:700;
    font-size:14.5px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    cursor:pointer;
    transition:opacity .2s ease;
    width: fit-content;
  }
  .banner-toggle:hover{ opacity:.8; }
  .banner-toggle svg{
    width:16px;
    height:16px;
    transition:transform .3s ease;
  }
  .banner-toggle.is-expanded svg{ transform:rotate(180deg); }

  .banner-photo {
    position: relative;
    clip-path: polygon(14% 0, 100% 0, 100% 100%, 0% 100%);
    height: 100%;
  }
  .banner-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
  }
  .banner-photo::after{
    content:'';position:absolute;inset:0;
    background:linear-gradient(15deg, rgba(20,27,77,.35), rgba(20,27,77,0) 55%);
  }
  .banner-stat{
    position:absolute;bottom:36px;right:36px;background:#fff;border-radius:var(--radius-sm);
    padding:14px 20px;box-shadow:var(--shadow);text-align:center;z-index:2;
  }
  .banner-stat strong{display:block;font-family:var(--font-display);font-size:26px;color:var(--blue);}
  .banner-stat span{font-size:12.5px;color:var(--ink-soft);font-weight:600;}

  /* ============ CERITA KAMI ============ */
  .story{padding:100px 0;}
  .story .wrap{display:grid;grid-template-columns:.95fr 1.05fr;gap:64px;align-items:center;}
  .story-visual{position:relative;height:440px;}
  .story-img{position:absolute;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow);}
  .story-img.a{width:74%;height:80%;top:0;left:0;}
  .story-img.a img{width:100%;height:100%;object-fit:cover;}
  .story-badge{
    position:absolute;bottom:6%;right:0;background:#fff;border-radius:var(--radius-md);
    padding:20px 24px;box-shadow:var(--shadow);text-align:center;
  }
  .story-badge strong{display:block;font-family:var(--font-display);font-size:30px;color:var(--blue);}
  .story-badge span{font-size:13px;color:var(--ink-soft);font-weight:600;}
  .story-copy > p{color:var(--ink-soft);margin-bottom:18px;max-width:520px;}
  .story-copy > p:last-of-type{margin-bottom:0;}

  /* FIX CERITA KAMI TEXT */
  .story-copy .story-text{
    position:relative;
    max-height: 220px; /* Dinaikkan agar muat 2-3 paragraf awal dari Filament */
    overflow:hidden;
    transition:max-height .45s ease;
  }
  .story-copy .story-text.expanded{ max-height:2000px; }
  .story-copy .story-text::after{
    content:'';
    position:absolute;left:0;right:0;bottom:0;
    height:50px; /* Dikecilkan dari 90px agar tidak menutupi seluruh teks */
    background:linear-gradient(180deg, rgba(255,255,255,0) 0%, #ffffff 90%);
    pointer-events:none;
    transition:opacity .3s ease;
  }
  .story-copy .story-text.expanded::after{ opacity:0; }

  .story-toggle{
    margin-top:16px;background:none;border:none;padding:0;
    color:var(--blue);font-weight:700;font-size:14.5px;
    display:inline-flex;align-items:center;gap:6px;cursor:pointer;
  }
  .story-toggle svg{width:16px;height:16px;transition:transform .3s ease;}
  .story-toggle.is-expanded svg{transform:rotate(180deg);}

  /* ============ VISI MISI ============ */
  .vm{padding:0 0 100px;}
  .vm-grid{display:grid;grid-template-columns:1fr 1fr;gap:26px;}
  .vm-card{
    border-radius:var(--radius-lg);padding:44px 38px;position:relative;overflow:hidden;
  }
  .vm-card.visi{background:linear-gradient(155deg,var(--blue-deep),var(--blue));color:#fff;}
  .vm-card.misi{background:var(--blue-tint);color:var(--ink);}
  .vm-icon{
    width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:22px;
  }
  .vm-card.visi .vm-icon{background:rgba(255,255,255,.14);}
  .vm-card.visi .vm-icon svg{width:26px;height:26px;color:#FFD877;}
  .vm-card.misi .vm-icon{background:#fff;}
  .vm-card.misi .vm-icon svg{width:26px;height:26px;color:var(--blue);}
  .vm-card h3{font-size:22px;margin-bottom:14px;}
  .vm-card.visi h3{color:#fff;}
  .vm-card p{font-size:15px;line-height:1.75;}
  .vm-card.visi p{color:rgba(255,255,255,.82);}
  .vm-card.misi p{color:var(--ink-soft);}
  .vm-card ul{display:grid;gap:10px;margin-top:6px;}
  .vm-card.misi li{display:flex;gap:10px;align-items:flex-start;font-size:14.5px;color:var(--ink-soft);}
  .vm-card.misi li svg{width:18px;height:18px;color:var(--blue);flex-shrink:0;margin-top:2px;}

  /* ============ NILAI-NILAI ============ */
  .values{padding:100px 0;background:var(--blue-tint);}
  .values-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:22px;}
  .value-card{
    background:#fff;border-radius:var(--radius-md);padding:32px 26px;text-align:center;
    box-shadow:var(--shadow);transition:transform .22s ease;
  }
  .value-card:hover{transform:translateY(-6px);}
  .value-icon{
    width:60px;height:60px;border-radius:50%;background:var(--blue-tint);margin:0 auto 20px;
    display:flex;align-items:center;justify-content:center;
  }
  .value-icon svg{width:27px;height:27px;color:var(--blue);}
  .value-card h4{font-size:17.5px;margin-bottom:10px;}
  .value-card p{font-size:14px;color:var(--ink-soft);}

  /* ============ STATS ============ */
  .stats{padding:90px 0;}
  .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;text-align:center;}
  .stat-item{padding:28px 16px;border-right:1px solid var(--line);}
  .stat-item:last-child{border-right:none;}
  .stat-num{
    font-family:var(--font-display);font-size:clamp(34px,4.4vw,46px);color:var(--blue);
    display:flex;align-items:center;justify-content:center;gap:4px;
  }
  .stat-label{font-size:14px;color:var(--ink-soft);font-weight:600;margin-top:6px;}

  /* ============ TIM KAMI ============ */
  .team{padding:100px 0;background:var(--blue-tint);}
  .team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;}
  .team-card{
    background:#fff;border-radius:var(--radius-md);overflow:hidden;box-shadow:var(--shadow);
    text-align:center;transition:transform .22s ease;
  }
  .team-card:hover{transform:translateY(-6px);}
  .team-photo{
    height:190px;background:linear-gradient(150deg,var(--blue-light),var(--blue-deep));
    display:flex;align-items:center;justify-content:center;
  }
  .team-photo img{width:96px;height:96px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,.5);}
  .team-info{padding:22px 18px 26px;}
  .team-info h4{font-size:16.5px;margin-bottom:4px;}
  .team-info span{font-size:13px;color:var(--blue);font-weight:700;}
  .team-note{margin-top:18px;font-size:13px;color:var(--ink-soft);text-align:center;}

  /* ============ TESTIMONI ============ */
  .testi{padding:100px 0;}
  .testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
  .testi-card{
    background:var(--blue-tint);border-radius:var(--radius-md);padding:30px 28px;position:relative;
  }
  .testi-quote-icon{width:30px;height:30px;color:var(--gold);margin-bottom:16px;}
  .testi-card p.msg{font-size:14.5px;color:var(--ink);line-height:1.75;margin-bottom:22px;min-height:110px;}
  .testi-person{display:flex;align-items:center;gap:12px;}
  .testi-person img{width:46px;height:46px;border-radius:50%;object-fit:cover;}
  .testi-person strong{display:block;font-size:14.5px;}
  .testi-person span{font-size:12.5px;color:var(--ink-soft);}

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
    .banner-inner{grid-template-columns:1fr;min-height:auto;}
    .banner-copy{padding:56px 24px 44px;order:2;}
    .banner-dots{display:none;}
    .banner-photo{clip-path:none;height:260px;order:1;}
    .banner-stat{bottom:16px;right:16px;padding:10px 16px;}
    .story .wrap{grid-template-columns:1fr;gap:40px;}
    .story-visual{height:340px;}
    .vm-grid{grid-template-columns:1fr;}
    .values-grid{grid-template-columns:repeat(2,1fr);}
    .team-grid{grid-template-columns:repeat(2,1fr);}
    .testi-grid{grid-template-columns:1fr;}
    .stats-grid{grid-template-columns:repeat(2,1fr);}
    .stat-item:nth-child(2){border-right:none;}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .cta-card{padding:40px 28px;}
  }
  
  @media (max-width:560px){
    .banner-copy{padding:44px 20px 36px;}
    .story-badge{padding:14px 18px;}
    
    /* Memaksa 2 kolom di HP untuk section Nilai-nilai */
    .values-grid {
      grid-template-columns: repeat(2, 1fr) !important;
      gap: 12px;
    }
    .value-card {
      padding: 20px 14px; 
    }
    .value-icon {
      width: 48px; height: 48px; margin-bottom: 14px;
    }
    .value-icon svg {
      width: 24px; height: 24px;
    }
    .value-card h4 {
      font-size: 14px; margin-bottom: 8px;
    }
    .value-card p {
      font-size: 12px; line-height: 1.5;
    }
  }
</style>
@endpush
@section('content')

<!-- ============ PAGE BANNER ============ -->
@if($banner)
<section class="banner">
  <div class="banner-inner">
    <div class="banner-copy reveal">
      <div class="banner-dots"></div>
      <div class="breadcrumb"><a href="{{ route('home') }}#home">Home</a><span>/</span><span class="current">Tentang Kami</span></div>
      <h1>{{ $banner->title }}</h1>

      <p class="lead-text" id="bannerText">{{ $banner->description }}</p>
      <button type="button" class="banner-toggle" id="bannerToggle">
        <span>Baca Selengkapnya</span>
        <svg viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
    </div>
    <div class="banner-photo reveal">
      @if($banner->getFirstMediaUrl('about_banner'))
        <img src="{{ $banner->getFirstMediaUrl('about_banner') }}" alt="{{ $banner->title }}">
      @else
        <img src="https://images.pexels.com/photos/18395403/pexels-photo-18395403.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Placeholder Banner">
      @endif
      <div class="banner-stat">
        <strong>{{ $banner->stat_number }}</strong>
        <span>{{ $banner->stat_label }}</span>
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ CERITA KAMI ============ -->
@if($story)
<section class="story">
  <div class="wrap">
    <div class="story-visual reveal">
      <div class="story-img a">
        @if($story->getFirstMediaUrl('about_story'))
          <img src="{{ $story->getFirstMediaUrl('about_story') }}" alt="Cerita Kami">
        @else
          <img src="https://images.pexels.com/photos/6325982/pexels-photo-6325982.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Placeholder Story">
        @endif
      </div>
      <div class="story-badge">
        <strong>{{ $story->badge_number }}</strong>
        <span>{{ $story->badge_label }}</span>
      </div>
    </div>
    <div class="story-copy reveal">
      <span class="eyebrow">{{ $story->eyebrow }}</span>
      <h2>{{ $story->title }}</h2>

      {{-- Karena menggunakan Rich Editor Filament, kita panggil pakai tag kurung kurawal tanda seru agar tag HTML terbaca --}}
      <div class="story-text" id="storyText" style="color: var(--ink-soft); line-height: 1.75; display: grid; gap: 18px;">
        {!! $story->description !!}
      </div>

      <button type="button" class="story-toggle" id="storyToggle">
        <span>Baca Selengkapnya</span>
        <svg viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
    </div>
  </div>
</section>
@endif

<!-- ============ VISI & MISI ============ -->
@if($visiMisi)
<section class="vm">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Visi &amp; Misi</span>
      <h2>Arah yang Kami Tuju</h2>
      <p>Setiap program dan keputusan kami selalu kembali pada dua hal ini.</p>
    </div>
    <div class="vm-grid reveal">
      <div class="vm-card visi">
        <div class="vm-icon">
            <!-- Menampilkan SVG dinamis Icon Mata -->
            {!! $visiMisi->visi_icon !!}
        </div>
        <h3>{{ $visiMisi->visi_title }}</h3>
        <p>{{ $visiMisi->visi_description }}</p>
      </div>
      <div class="vm-card misi">
        <div class="vm-icon">
            <!-- Menampilkan SVG dinamis Icon Target -->
            {!! $visiMisi->misi_icon !!}
        </div>
        <h3>{{ $visiMisi->misi_title }}</h3>
        <ul>
          @if($visiMisi->misi_points)
            @foreach($visiMisi->misi_points as $misi)
              <li>
                <!-- Menampilkan SVG dinamis Icon Ceklis -->
                {!! $visiMisi->check_icon !!}
                {{ $misi['point'] ?? '' }}
              </li>
            @endforeach
          @endif
        </ul>
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ NILAI-NILAI KAMI ============ -->
<section class="values">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Nilai-Nilai Kami</span>
      <h2>Prinsip yang Kami Pegang Teguh</h2>
      <p>Lima nilai S.M.A.R.T menjadi landasan utama dalam setiap proses pembelajaran dan pendampingan siswa kami.</p>
    </div>
    <div class="values-grid reveal">
      @forelse($values as $value)
        <div class="value-card">
          <div class="value-icon">
            <!-- Icon SVG digenerate otomatis berdasarkan Judul -->
            {!! $value->icon !!}
          </div>
          <h4>{{ $value->title }}</h4>
          <p>{{ $value->description }}</p>
        </div>
      @empty
        <p>Belum ada nilai yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ STATS ============ -->
<section class="stats">
  <div class="wrap">
    <div class="stats-grid reveal">
      @foreach($stats as $stat)
        <div class="stat-item">
          <!-- Memisahkan angka (untuk animasi) dan huruf/simbol (seperti tanda +) -->
          @php
            $numberOnly = preg_replace('/[^0-9]/', '', $stat->value);
            $symbolOnly = preg_replace('/[0-9]/', '', $stat->value);
          @endphp
          <div class="stat-num"><span class="counter" data-target="{{ $numberOnly }}">0</span><span>{{ $symbolOnly }}</span></div>
          <div class="stat-label">{{ $stat->label }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============ TIM KAMI ============ -->
<section class="team">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Tim Kami</span>
      <h2>Orang-Orang di Balik Bimbel Smart</h2>
      <p>Dipimpin oleh tim yang berpengalaman di bidang pendidikan dan pengelolaan bimbingan belajar.</p>
    </div>
    <div class="team-grid reveal">
      @forelse($teams as $member)
        <div class="team-card">
          <div class="team-photo">
            @if($member->getFirstMediaUrl('team_images'))
              <img src="{{ $member->getFirstMediaUrl('team_images') }}" alt="Foto {{ $member->name }}">
            @else
              <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=FFD877&color=141B4D&bold=true&size=128" alt="Foto placeholder {{ $member->name }}">
            @endif
          </div>
          <div class="team-info">
            <h4>{{ $member->name }}</h4>
            <span>{{ $member->position }}</span>
          </div>
        </div>
      @empty
        <p>Belum ada data tim yang ditambahkan.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ TESTIMONI ============ -->
<section class="testi">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Kata Mereka</span>
      <h2>Apa Kata Orang Tua &amp; Siswa Kami</h2>
      <p>Cerita nyata dari keluarga yang sudah belajar bersama Bimbel Smart.</p>
    </div>
    <div class="testi-grid reveal">
      @forelse($testimonials as $testi)
        <div class="testi-card">
          <svg class="testi-quote-icon" viewBox="0 0 24 24" fill="none"><path d="M7 7a4 4 0 00-4 4v6h6v-6H6a2 2 0 012-2V7zM17 7a4 4 0 00-4 4v6h6v-6h-3a2 2 0 012-2V7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
          <p class="msg">"{{ $testi->message }}"</p>
          <div class="testi-person">
            @if($testi->getFirstMediaUrl('testi_avatars'))
              <img src="{{ $testi->getFirstMediaUrl('testi_avatars') }}" alt="{{ $testi->name }}">
            @else
              <img src="https://ui-avatars.com/api/?name={{ urlencode($testi->name) }}&background=2C3E9E&color=fff&bold=true&size=92" alt="Foto placeholder {{ $testi->name }}">
            @endif
            <div><strong>{{ $testi->name }}</strong><span>{{ $testi->role }}</span></div>
          </div>
        </div>
      @empty
        <p>Belum ada testimoni.</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Yuk, Mulai Perjalanan Belajar Bersama Kami</h2>
      <p>Konsultasikan kebutuhan belajar anak Anda secara gratis dengan tim Bimbel Smart hari ini.</p>
      <div class="cta-actions">
        <a href="{{ route('kontak') }}#form-kontak" class="btn btn-primary">Hubungi Kami</a>
        <a href="{{ route('home') }}#program" class="btn btn-outline-light">Lihat Program</a>
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')
<script>
// Counter animation for stats
  const counters = document.querySelectorAll('.counter');
  const counterIO = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.dataset.target, 10);
        const duration = 1400;
        const startTime = performance.now();
        function tick(now) {
          const progress = Math.min((now - startTime) / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3);
          el.textContent = Math.floor(eased * target);
          if (progress < 1) requestAnimationFrame(tick);
          else el.textContent = target;
        }
        requestAnimationFrame(tick);
        counterIO.unobserve(el);
      }
    });
  }, { threshold: 0.4 });
  counters.forEach(el => counterIO.observe(el));

  // Toggle baca selengkapnya untuk Banner (Mengenal Lebih Dekat)
  const bannerText = document.getElementById('bannerText');
  const bannerToggle = document.getElementById('bannerToggle');

  if (bannerText && bannerToggle) {
    requestAnimationFrame(() => {
      if (bannerText.scrollHeight <= bannerText.clientHeight + 10) {
        bannerToggle.style.display = 'none';
      }
    });

    bannerToggle.addEventListener('click', () => {
      const expanded = bannerText.classList.toggle('expanded');
      bannerToggle.classList.toggle('is-expanded', expanded);
      bannerToggle.querySelector('span').textContent = expanded ? 'Tutup' : 'Baca Selengkapnya';
    });
  }

  // Toggle baca selengkapnya untuk Cerita Kami
  const storyText = document.getElementById('storyText');
  const storyToggle = document.getElementById('storyToggle');

  if (storyText && storyToggle) {
    // Sembunyikan tombol kalau konten pendek dan nggak perlu di-collapse
    requestAnimationFrame(() => {
      if (storyText.scrollHeight <= storyText.clientHeight + 10) {
        storyToggle.style.display = 'none';
      }
    });

    storyToggle.addEventListener('click', () => {
      const expanded = storyText.classList.toggle('expanded');
      storyToggle.classList.toggle('is-expanded', expanded);
      storyToggle.querySelector('span').textContent = expanded ? 'Tutup' : 'Baca Selengkapnya';
    });
  }
</script>
@endpush