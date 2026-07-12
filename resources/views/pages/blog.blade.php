@extends('layouts.app')

@section('title', 'Blog & Tips Belajar — Bimbel Smart')
@section('page', 'blog')

@push('styles')
<style>
/* Token, reset, tombol, navbar & mobile-nav dasar sudah ada di assets/style.css */


  /* ============ PAGE BANNER (khusus Blog — center + search, beda dari halaman lain) ============ */
  .banner{
    padding:76px 0 60px;text-align:center;position:relative;overflow:hidden;
    background:linear-gradient(180deg,var(--blue-tint) 0%, #fff 85%);
  }
  .banner-float{
    position:absolute;font-weight:700;font-size:13px;color:var(--blue);background:#fff;
    border:1.5px solid var(--line);padding:8px 16px;border-radius:100px;opacity:.7;box-shadow:var(--shadow);
  }
  .banner-float.f1{top:18%;left:6%;transform:rotate(-8deg);}
  .banner-float.f2{top:12%;right:8%;transform:rotate(7deg);}
  .banner-float.f3{bottom:14%;left:11%;transform:rotate(6deg);}
  .banner-float.f4{bottom:20%;right:5%;transform:rotate(-6deg);}
  .breadcrumb{display:flex;justify-content:center;gap:8px;font-size:14px;color:var(--ink-soft);margin-bottom:22px;position:relative;z-index:2;}
  .breadcrumb a{font-weight:600;color:var(--ink-soft);}
  .breadcrumb .current{font-weight:700;color:var(--gold-deep);}
  .banner h1{position:relative;z-index:2;font-size:clamp(30px,4vw,44px);max-width:660px;margin:0 auto 16px;}
  .banner p.lead{position:relative;z-index:2;color:var(--ink-soft);max-width:520px;margin:0 auto 34px;font-size:16.5px;}
  .search-box{
    position:relative;z-index:2;max-width:480px;margin:0 auto;display:flex;align-items:center;gap:10px;
    background:#fff;border:1.5px solid var(--line);border-radius:100px;padding:6px 8px 6px 22px;box-shadow:var(--shadow);
  }
  .search-box svg{width:19px;height:19px;color:var(--ink-soft);flex-shrink:0;}
  .search-box input{flex:1;border:none;background:transparent;font-family:inherit;font-size:14.5px;padding:10px 0;}
  .search-box input:focus{outline:none;}
  .search-box button{background:var(--gold);color:var(--blue-deep);font-weight:700;font-size:14px;padding:11px 22px;border-radius:100px;flex-shrink:0;}

  /* ============ FEATURED POST ============ */
  .featured{padding:70px 0 30px;}
  .featured-card{
    display:grid;grid-template-columns:1fr 1fr;background:var(--blue-tint);border-radius:var(--radius-lg);overflow:hidden;
  }
  .featured-media{position:relative;min-height:340px;}
  .featured-media img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
  .featured-media .tag{
    position:absolute;top:20px;left:20px;background:#fff;color:var(--blue);font-size:12px;font-weight:800;
    padding:6px 14px;border-radius:100px;text-transform:uppercase;letter-spacing:.03em;z-index:2;
  }
  .featured-body{padding:44px 44px 44px 40px;display:flex;flex-direction:column;justify-content:center;}
  .featured-meta{display:flex;gap:14px;align-items:center;font-size:13px;color:var(--ink-soft);margin-bottom:14px;font-weight:600;}
  .featured-meta .dot{width:4px;height:4px;border-radius:50%;background:var(--ink-soft);}
  .featured-body h2{font-size:clamp(22px,2.6vw,28px);margin-bottom:14px;}
  .featured-body p.excerpt{color:var(--ink-soft);font-size:15px;margin-bottom:24px;}

  /* ============ FILTER + GRID ============ */
  .bloglist{padding:40px 0 100px;}
  .filter-row{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:44px;}
  .filter-pill{
    padding:10px 20px;border-radius:100px;border:1.5px solid var(--line);font-weight:700;font-size:13.5px;color:var(--ink-soft);
    background:#fff;transition:all .2s ease;
  }
  .filter-pill:hover{border-color:var(--blue);color:var(--blue);}
  .filter-pill.active{background:var(--blue);border-color:var(--blue);color:#fff;}

  .blog-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
  .blog-card{
    background:#fff;border:1px solid var(--line);border-radius:var(--radius-md);overflow:hidden;
    transition:transform .22s ease, box-shadow .22s ease;
  }
  .blog-card:hover{transform:translateY(-6px);box-shadow:var(--shadow);}
  .blog-card.hidden{display:none;}
  .blog-thumb{height:190px;position:relative;overflow:hidden;display:block;}
  .blog-thumb img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
  .blog-thumb .tag{
    position:absolute;top:14px;left:14px;background:rgba(255,255,255,.94);color:var(--blue);font-size:11.5px;font-weight:800;
    padding:5px 12px;border-radius:100px;text-transform:uppercase;letter-spacing:.03em;z-index:2;
  }
  .blog-body{padding:22px 22px 26px;}
  .blog-meta{font-size:12.5px;color:var(--ink-soft);margin-bottom:10px;display:block;}
  .blog-body h3{font-size:17px;margin-bottom:10px;line-height:1.35;}
  .blog-body h3 a{color:inherit;}
  .blog-body p{font-size:14px;color:var(--ink-soft);margin-bottom:16px;}
  .empty-state{display:none;text-align:center;padding:50px 20px;color:var(--ink-soft);}
  .empty-state.show{display:block;}

  /* ============ NEWSLETTER CTA ============ */
  .cta{padding:0 0 110px;}
  .cta-card{background:linear-gradient(155deg,var(--blue-deep),var(--blue));border-radius:var(--radius-lg);padding:60px;text-align:center;color:#fff;position:relative;overflow:hidden;}
  .cta-card::before{content:'';position:absolute;width:320px;height:320px;border-radius:50%;background:rgba(255,183,3,.14);top:-140px;right:-80px;}
  .cta-card h2{color:#fff;font-size:clamp(24px,3.2vw,32px);margin-bottom:12px;position:relative;}
  .cta-card p{color:rgba(255,255,255,.8);max-width:460px;margin:0 auto 28px;position:relative;}
  .cta-form{position:relative;display:flex;gap:0;max-width:420px;margin:0 auto;border-radius:100px;overflow:hidden;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);}
  .cta-form input{flex:1;background:transparent;border:none;padding:15px 20px;color:#fff;font-size:14.5px;font-family:inherit;}
  .cta-form input::placeholder{color:rgba(255,255,255,.55);}
  .cta-form input:focus{outline:none;}
  .cta-form button{background:var(--gold);color:var(--blue-deep);font-weight:700;font-size:14px;padding:0 26px;}

  /* Style footer & reveal dasar sudah ada di assets/style.css */


  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .nav-links{display:none;}
    .burger{display:flex;}
    .nav-cta .btn-primary{display:none;}
    .banner-float{display:none;}
    .featured-card{grid-template-columns:1fr;}
    .featured-media{min-height:220px;}
    .featured-body{padding:30px 26px;}
    .blog-grid{grid-template-columns:repeat(2,1fr);}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .cta-card{padding:40px 26px;}
    .cta-form{flex-direction:column;border-radius:var(--radius-md);}
    .cta-form button{padding:14px;}
  }
  @media (max-width:560px){
    .banner{padding:56px 0 44px;}
    .search-box{flex-wrap:wrap;padding:16px 18px;border-radius:var(--radius-md);}
    .search-box input{width:100%;order:1;}
    .search-box svg{order:0;}
    .search-box button{order:2;width:100%;}
    .blog-grid{grid-template-columns:1fr;}
    .filter-row{overflow-x:auto;flex-wrap:nowrap;padding-bottom:6px;}
  }
</style>
@endpush

@section('content')
<!-- ============ PAGE BANNER ============ -->
<section class="banner">
  <span class="banner-float f1">#TipsBelajar</span>
  <span class="banner-float f2">#UTBK2026</span>
  <span class="banner-float f3">#Parenting</span>
  <span class="banner-float f4">#EnglishCorner</span>
  <div class="wrap">
    <div class="breadcrumb reveal"><a href="{{ route('home') }}#home">Home</a><span>/</span><span class="current">Blog</span></div>
    <h1 class="reveal">Blog &amp; Tips Belajar Bimbel Smart</h1>
    <p class="lead reveal">Kumpulan artikel seputar tips belajar, info pendidikan terbaru, dan cerita inspiratif untuk orang tua dan siswa.</p>
    <div class="search-box reveal">
      <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8"/><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      <input type="text" id="searchInput" placeholder="Cari artikel, misal 'UTBK'...">
      <button id="searchBtn">Cari</button>
    </div>
  </div>
</section>

<!-- ============ FEATURED POST ============ -->
<section class="featured">
  <div class="wrap">
    <div class="featured-card reveal">
      <div class="featured-media">
        <img src="https://images.pexels.com/photos/9572630/pexels-photo-9572630.jpeg?auto=compress&cs=tinysrgb&w=900" alt="Dua siswa belajar bersama di perpustakaan (foto stok)">
        <span class="tag">Artikel Pilihan</span>
      </div>
      <div class="featured-body">
        <div class="featured-meta"><span>Tips Belajar</span><span class="dot"></span><span>28 Jun 2026</span><span class="dot"></span><span>5 min baca</span></div>
        <h2>5 Kebiasaan Kecil yang Bikin Anak Makin Semangat Belajar</h2>
        <p class="excerpt">Kadang yang dibutuhkan bukan jadwal belajar yang lebih ketat, tapi kebiasaan kecil yang tepat. Simak lima kebiasaan sederhana yang terbukti membantu anak lebih semangat dan konsisten belajar setiap hari.</p>
        <a href="{{ route('blog.show', '5-kebiasaan-kecil-bikin-anak-semangat-belajar') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ FILTER + GRID ARTIKEL ============ -->
<section class="bloglist">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Semua Artikel</span>
      <h2>Jelajahi Artikel Lainnya</h2>
    </div>

    <div class="filter-row reveal">
      <button class="filter-pill active" data-filter="semua">Semua</button>
      <button class="filter-pill" data-filter="tips">Tips Belajar</button>
      <button class="filter-pill" data-filter="info">Info Pendidikan</button>
      <button class="filter-pill" data-filter="sukses">Cerita Sukses</button>
      <button class="filter-pill" data-filter="english">English Corner</button>
      <button class="filter-pill" data-filter="parenting">Parenting</button>
    </div>

    <div class="blog-grid" id="blogGrid">

      <article class="blog-card" data-category="tips" data-title="cara menyusun jadwal belajar yang realistis untuk anak sd">
        <a class="blog-thumb" href="{{ route('blog.show', 'cara-menyusun-jadwal-belajar-realistis-anak-sd') }}">
          <img src="https://images.pexels.com/photos/6214651/pexels-photo-6214651.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Anak membaca buku di ruang belajar (foto stok)">
          <span class="tag">Tips Belajar</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">25 Jun 2026 &middot; 4 min baca</span>
          <h3><a href="{{ route('blog.show', 'cara-menyusun-jadwal-belajar-realistis-anak-sd') }}">Cara Menyusun Jadwal Belajar yang Realistis untuk Anak SD</a></h3>
          <p>Jadwal belajar yang terlalu padat justru bikin anak cepat lelah. Ini cara menyusunnya biar tetap efektif.</p>
          <a href="{{ route('blog.show', 'cara-menyusun-jadwal-belajar-realistis-anak-sd') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

      <article class="blog-card" data-category="info" data-title="yang berubah dari utbk 2026 orang tua wajib tahu">
        <a class="blog-thumb" href="{{ route('blog.show', 'yang-berubah-dari-utbk-2026') }}">
          <img src="https://images.pexels.com/photos/6684209/pexels-photo-6684209.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Siswa mengerjakan ujian (foto stok)">
          <span class="tag">Info Pendidikan</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">22 Jun 2026 &middot; 6 min baca</span>
          <h3><a href="{{ route('blog.show', 'yang-berubah-dari-utbk-2026') }}">Yang Berubah dari UTBK 2026, Orang Tua Wajib Tahu</a></h3>
          <p>Ada beberapa penyesuaian format dan jadwal UTBK tahun ini yang penting diketahui sejak awal.</p>
          <a href="{{ route('blog.show', 'yang-berubah-dari-utbk-2026') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

      <article class="blog-card" data-category="sukses" data-title="dari nilai pas pasan ke juara kelas cerita kirana">
        <a class="blog-thumb" href="{{ route('blog.show', 'dari-nilai-pas-pasan-ke-juara-kelas-kirana') }}">
          <img src="https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Wisuda mahasiswa (foto stok)">
          <span class="tag">Cerita Sukses</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">19 Jun 2026 &middot; 5 min baca</span>
          <h3><a href="{{ route('blog.show', 'dari-nilai-pas-pasan-ke-juara-kelas-kirana') }}">Dari Nilai Pas-Pasan ke Juara Kelas: Cerita Kirana</a></h3>
          <p>Perjalanan seorang siswa yang awalnya minder soal Matematika, sampai akhirnya jadi juara kelas.</p>
          <a href="{{ route('blog.show', 'dari-nilai-pas-pasan-ke-juara-kelas-kirana') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

      <article class="blog-card" data-category="english" data-title="5 aplikasi seru untuk latihan speaking bahasa inggris">
        <a class="blog-thumb" href="{{ route('blog.show', '5-aplikasi-seru-latihan-speaking-bahasa-inggris') }}">
          <img src="https://images.pexels.com/photos/6325982/pexels-photo-6325982.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Tutor membimbing siswa belajar (foto stok)">
          <span class="tag">English Corner</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">16 Jun 2026 &middot; 3 min baca</span>
          <h3><a href="{{ route('blog.show', '5-aplikasi-seru-latihan-speaking-bahasa-inggris') }}">5 Aplikasi Seru untuk Latihan Speaking Bahasa Inggris</a></h3>
          <p>Belajar speaking nggak melulu lewat buku. Coba lima aplikasi ini biar anak makin pede ngomong Inggris.</p>
          <a href="{{ route('blog.show', '5-aplikasi-seru-latihan-speaking-bahasa-inggris') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

      <article class="blog-card" data-category="tips" data-title="menumbuhkan minat baca pada anak sejak dini">
        <a class="blog-thumb" href="{{ route('blog.show', 'menumbuhkan-minat-baca-pada-anak-sejak-dini') }}">
          <img src="https://images.pexels.com/photos/10638213/pexels-photo-10638213.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Anak-anak membaca buku bersama (foto stok)">
          <span class="tag">Tips Belajar</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">13 Jun 2026 &middot; 4 min baca</span>
          <h3><a href="{{ route('blog.show', 'menumbuhkan-minat-baca-pada-anak-sejak-dini') }}">Menumbuhkan Minat Baca pada Anak Sejak Dini</a></h3>
          <p>Minat baca nggak muncul begitu saja — ini beberapa kebiasaan kecil yang bisa orang tua mulai dari rumah.</p>
          <a href="{{ route('blog.show', 'menumbuhkan-minat-baca-pada-anak-sejak-dini') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

      <article class="blog-card" data-category="parenting" data-title="cara mendampingi anak belajar tanpa baper">
        <a class="blog-thumb" href="{{ route('blog.show', 'cara-mendampingi-anak-belajar-tanpa-baper') }}">
          <img src="https://images.pexels.com/photos/8926887/pexels-photo-8926887.jpeg?auto=compress&cs=tinysrgb&w=500" alt="Anak-anak belajar di perpustakaan (foto stok)">
          <span class="tag">Parenting</span>
        </a>
        <div class="blog-body">
          <span class="blog-meta">10 Jun 2026 &middot; 5 min baca</span>
          <h3><a href="{{ route('blog.show', 'cara-mendampingi-anak-belajar-tanpa-baper') }}">Cara Mendampingi Anak Belajar Tanpa Baper</a></h3>
          <p>Sering emosi tiap dampingi anak belajar di rumah? Coba beberapa pendekatan ini biar sesi belajar tetap adem.</p>
          <a href="{{ route('blog.show', 'cara-mendampingi-anak-belajar-tanpa-baper') }}" class="link-arrow">Baca Selengkapnya <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        </div>
      </article>

    </div>
    <p class="empty-state" id="emptyState">Belum ada artikel yang cocok dengan pencarian atau kategori ini.</p>
  </div>
</section>

<!-- ============ NEWSLETTER CTA ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Nggak Mau Ketinggalan Artikel Baru?</h2>
      <p>Daftar newsletter kami dan dapatkan tips belajar terbaru langsung ke email kamu setiap minggu.</p>
      <form class="cta-form" id="ctaNewsletterForm">
        <input type="email" placeholder="Alamat email kamu" required>
        <button type="submit">Berlangganan</button>
      </form>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
// Filter + search logic
  const filterPills = document.querySelectorAll('.filter-pill');
  const cards = document.querySelectorAll('.blog-card');
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.getElementById('searchBtn');
  const emptyState = document.getElementById('emptyState');
  let activeFilter = 'semua';

  function applyFilters() {
    const query = searchInput.value.trim().toLowerCase();
    let visibleCount = 0;
    cards.forEach(card => {
      const matchesCategory = activeFilter === 'semua' || card.dataset.category === activeFilter;
      const matchesSearch = query === '' || card.dataset.title.includes(query);
      const show = matchesCategory && matchesSearch;
      card.classList.toggle('hidden', !show);
      if (show) visibleCount++;
    });
    emptyState.classList.toggle('show', visibleCount === 0);
  }

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      activeFilter = pill.dataset.filter;
      applyFilters();
    });
  });
  searchBtn.addEventListener('click', applyFilters);
  searchInput.addEventListener('keyup', (e) => { if (e.key === 'Enter') applyFilters(); else applyFilters(); });

  // Newsletter forms (demo only, no backend)
  const ctaForm = document.getElementById('ctaNewsletterForm');
  ctaForm.addEventListener('submit', (e) => {
    e.preventDefault();
    ctaForm.querySelector('input').value = '';
    ctaForm.querySelector('input').placeholder = 'Berhasil berlangganan!';
  });
</script>
@endpush