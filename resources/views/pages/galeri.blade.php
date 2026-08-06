@extends('layouts.app')

@section('title', 'Galeri Kegiatan — Bimbel Smart')
@section('page', 'galeri')

@push('styles')
<style>
/* Token, reset, tombol, navbar & mobile-nav dasar sudah ada di assets/style.css */


  /* ============ PAGE BANNER (khusus Galeri — mozaik foto, beda dari halaman lain) ============ */
  .banner{padding:64px 0 0;overflow:hidden;}
  .breadcrumb{display:flex;justify-content:center;gap:8px;font-size:14px;color:var(--ink-soft);margin-bottom:22px;}
  .breadcrumb a{font-weight:600;color:var(--ink-soft);}
  .breadcrumb .current{font-weight:700;color:var(--gold-deep);}
  .banner-copy{text-align:center;max-width:640px;margin:0 auto 40px;}
  .banner-copy h1{font-size:clamp(30px,4vw,44px);margin-bottom:16px;}
  .banner-copy p.lead{color:var(--ink-soft);font-size:16.5px;}

  .mosaic{display:grid;grid-template-columns:repeat(6,1fr);grid-auto-rows:80px;gap:12px;padding-bottom:56px;}
  .mosaic-item{border-radius:var(--radius-sm);overflow:hidden;position:relative;}
  .mosaic-item img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;}
  .mosaic-item:hover img{transform:scale(1.07);}
  .m1{grid-column:1/3;grid-row:1/4;}
  .m2{grid-column:3/5;grid-row:1/3;}
  .m3{grid-column:5/7;grid-row:1/3;}
  .m4{grid-column:3/4;grid-row:3/5;}
  .m5{grid-column:4/7;grid-row:3/5;}
  .m6{grid-column:1/3;grid-row:4/6;}

  /* ============ FILTER + GRID GALERI ============ */
  .gallery{padding:20px 0 100px;}
  .filter-row{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px;}
  .filter-pill{
    padding:10px 20px;border-radius:100px;border:1.5px solid var(--line);font-weight:700;font-size:13.5px;color:var(--ink-soft);
    background:#fff;transition:all .2s ease;
  }
  .filter-pill:hover{border-color:var(--blue);color:var(--blue);}
  .filter-pill.active{background:var(--blue);border-color:var(--blue);color:#fff;}

  .gal-grid{columns:3;column-gap:20px;}
  .gal-item{
    break-inside:avoid;margin-bottom:20px;border-radius:var(--radius-md);overflow:hidden;position:relative;cursor:pointer;
  }
  .gal-item.hidden{display:none;}
  .gal-item img{width:100%;display:block;transition:transform .35s ease;}
  .gal-item:hover img{transform:scale(1.06);}
  .gal-overlay{
    position:absolute;inset:0;background:linear-gradient(180deg,rgba(20,27,77,0) 45%,rgba(10,14,40,.72));
    display:flex;align-items:flex-end;padding:18px;opacity:0;transition:opacity .25s ease;
  }
  .gal-item:hover .gal-overlay{opacity:1;}
  .gal-overlay .info strong{display:block;color:#fff;font-size:14.5px;margin-bottom:3px;}
  .gal-overlay .info span{color:rgba(255,255,255,.75);font-size:12px;}
  .gal-zoom{
    position:absolute;top:14px;right:14px;width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.92);
    display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .25s ease;
  }
  .gal-item:hover .gal-zoom{opacity:1;}
  .gal-zoom svg{width:16px;height:16px;color:var(--blue);}
  .empty-state{display:none;text-align:center;padding:50px 20px;color:var(--ink-soft);}
  .empty-state.show{display:block;}

  /* ============ LIGHTBOX ============ */
  .lightbox{
    position:fixed;inset:0;background:rgba(10,14,40,.92);z-index:300;display:none;
    align-items:center;justify-content:center;padding:24px;
  }
  .lightbox.open{display:flex;}
  .lightbox-inner{position:relative;max-width:880px;width:100%;}
  .lightbox-inner img{width:100%;max-height:78vh;object-fit:contain;border-radius:var(--radius-md);background:#000;}
  .lightbox-caption{color:#fff;text-align:center;margin-top:16px;}
  .lightbox-caption strong{display:block;font-size:16px;margin-bottom:4px;}
  .lightbox-caption span{color:rgba(255,255,255,.6);font-size:13.5px;}
  .lb-close, .lb-prev, .lb-next{
    position:absolute;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.12);
    display:flex;align-items:center;justify-content:center;transition:background .2s ease;
  }
  .lb-close:hover, .lb-prev:hover, .lb-next:hover{background:rgba(255,255,255,.25);}
  .lb-close svg, .lb-prev svg, .lb-next svg{width:18px;height:18px;color:#fff;}
  .lb-close{top:-56px;right:0;}
  .lb-prev{left:-56px;top:50%;transform:translateY(-50%);}
  .lb-next{right:-56px;top:50%;transform:translateY(-50%);}

  /* ============ CTA ============ */
  .cta{padding:0 0 110px;}
  .cta-card{background:linear-gradient(155deg,var(--blue-deep),var(--blue));border-radius:var(--radius-lg);padding:60px;text-align:center;color:#fff;position:relative;overflow:hidden;}
  .cta-card::before{content:'';position:absolute;width:320px;height:320px;border-radius:50%;background:rgba(255,183,3,.14);top:-140px;right:-80px;}
  .cta-card h2{color:#fff;font-size:clamp(24px,3.2vw,32px);margin-bottom:12px;position:relative;}
  .cta-card p{color:rgba(255,255,255,.8);max-width:460px;margin:0 auto 28px;position:relative;}
  .cta-actions{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;position:relative;}

  /* Style footer & reveal dasar sudah ada di assets/style.css */


  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .nav-links{display:none;}
    .burger{display:flex;}
    .nav-cta .btn-primary{display:none;}
    .mosaic{grid-template-columns:repeat(4,1fr);grid-auto-rows:70px;}
    .m1{grid-column:1/3;grid-row:1/4;}
    .m2{grid-column:3/5;grid-row:1/3;}
    .m3{display:none;}
    .m4{grid-column:3/4;grid-row:3/5;}
    .m5{grid-column:4/5;grid-row:3/5;}
    .m6{grid-column:1/3;grid-row:4/6;}
    .gal-grid{columns:2;}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .cta-card{padding:40px 26px;}
    .lb-prev{left:0;}
    .lb-next{right:0;}
    .lb-close{top:-52px;}
  }
  @media (max-width:560px){
    .gal-grid{columns:1;}
    .mosaic{grid-template-columns:repeat(2,1fr);grid-auto-rows:110px;}
    .m1{grid-column:1/3;grid-row:1/3;}
    .m2,.m3{display:none;}
    .m4{grid-column:1/2;grid-row:3/4;}
    .m5{grid-column:2/3;grid-row:3/4;}
    .m6{grid-column:1/3;grid-row:4/5;}
    .filter-row{overflow-x:auto;flex-wrap:nowrap;padding-bottom:6px;}
  }
</style>
@endpush

@section('content')
<!-- ============ PAGE BANNER ============ -->
<section class="banner">
  <div class="wrap">
    <div class="breadcrumb reveal"><a href="{{ route('home') }}#home">Home</a><span>/</span><span class="current">Galeri</span></div>
    <div class="banner-copy reveal">
      <h1>Momen Belajar di Bimbel Smart</h1>
      <p class="lead">Cuplikan suasana kelas, try out, kunjungan kampus, sampai hari wisuda para siswa kami.</p>
    </div>
      <div class="mosaic reveal">
        <!-- Meja belajar dari atas (Buku dan kacamata) -->
        <div class="mosaic-item m1"><img src="https://images.pexels.com/photos/301920/pexels-photo-301920.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Meja belajar dan buku"></div>
        
        <!-- Topi Toga dan Ijazah di atas meja (Wisuda, tanpa orang) -->
        <div class="mosaic-item m2"><img src="https://images.pexels.com/photos/1205651/pexels-photo-1205651.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Topi toga dan ijazah"></div>
        
        <!-- Lorong rak buku perpustakaan (Fasilitas) -->
        <div class="mosaic-item m3"><img src="https://images.pexels.com/photos/256502/pexels-photo-256502.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Rak buku perpustakaan"></div>
        
        <!-- Tangan sedang menulis di atas kertas (Try out/Ujian) -->
        <div class="mosaic-item m4"><img src="https://images.pexels.com/photos/3729557/pexels-photo-3729557.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Siswa sedang try out"></div>
        
        <!-- Tangan mengetik di laptop (Fokus belajar/coding) -->
        <div class="mosaic-item m5"><img src="https://images.pexels.com/photos/5905709/pexels-photo-5905709.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Fokus belajar mandiri di laptop"></div>
        
        <!-- Tumpukan buku estetik (Pojok baca/materi) -->
        <div class="mosaic-item m6"><img src="https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Tumpukan buku pelajaran"></div>
      </div>
  </div>
</section>

<!-- ============ FILTER + GRID GALERI ============ -->
<section class="gallery">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Semua Foto</span>
      <h2>Jelajahi Galeri Kami</h2>
      <p>Klik salah satu foto untuk melihatnya lebih besar.</p>
    </div>

    <div class="filter-row reveal">
  <button class="filter-pill active" data-filter="semua">Semua</button>
  @foreach($categories as $cat)
    <button class="filter-pill" data-filter="{{ $cat }}">{{ $cat }}</button>
  @endforeach
</div>

    <div class="gal-grid reveal" id="galGrid">
  @forelse($galleries as $gallery)
    <div class="gal-item"
         data-category="{{ $gallery->category }}"
         data-caption="{{ $gallery->title }}"
         data-date="{{ \Carbon\Carbon::parse($gallery->date)->locale('id')->translatedFormat('F Y') }}">
      <img src="{{ $gallery->getFirstMediaUrl('gallery_images') }}" alt="{{ $gallery->title }}">
      <div class="gal-zoom">
        <svg viewBox="0 0 24 24" fill="none"><path d="M11 4a7 7 0 100 14 7 7 0 000-14zM21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      </div>
      <div class="gal-overlay">
        <div class="info">
          <strong>{{ $gallery->title }}</strong>
          <span>{{ \Carbon\Carbon::parse($gallery->date)->locale('id')->translatedFormat('F Y') }}</span>
        </div>
      </div>
    </div>
  @empty
    <p>Belum ada foto galeri.</p>
  @endforelse
</div>
    <p class="empty-state" id="emptyState">Belum ada foto untuk kategori ini.</p>
  </div>
</section>

<!-- ============ LIGHTBOX ============ -->
<div class="lightbox" id="lightbox">
  <div class="lightbox-inner">
    <button class="lb-close" id="lbClose"><svg viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
    <button class="lb-prev" id="lbPrev"><svg viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
    <img id="lbImage" src="" alt="">
    <button class="lb-next" id="lbNext"><svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
    <div class="lightbox-caption"><strong id="lbCaption"></strong><span id="lbDate"></span></div>
  </div>
</div>

<!-- ============ CTA ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Ingin Anak Anda Jadi Bagian dari Cerita Ini?</h2>
      <p>Gabung sekarang dan rasakan sendiri serunya belajar di Bimbel Smart.</p>
      <div class="cta-actions">
        <a href="{{ route('home') }}#kontak" class="btn btn-primary">Daftar Sekarang</a>
        <a href="{{ route('layanan') }}" class="btn btn-outline-light">Lihat Program</a>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
// Filter logic
  const filterPills = document.querySelectorAll('.filter-pill');
  const galItems = document.querySelectorAll('.gal-item');
  const emptyState = document.getElementById('emptyState');

  function applyFilter(filter) {
    let visibleCount = 0;
    galItems.forEach(item => {
      const show = filter === 'semua' || item.dataset.category === filter;
      item.classList.toggle('hidden', !show);
      if (show) visibleCount++;
    });
    emptyState.classList.toggle('show', visibleCount === 0);
  }

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      applyFilter(pill.dataset.filter);
    });
  });

  // Lightbox logic
  const lightbox = document.getElementById('lightbox');
  const lbImage = document.getElementById('lbImage');
  const lbCaption = document.getElementById('lbCaption');
  const lbDate = document.getElementById('lbDate');
  const lbClose = document.getElementById('lbClose');
  const lbPrev = document.getElementById('lbPrev');
  const lbNext = document.getElementById('lbNext');
  let currentIndex = 0;
  let visibleItems = [];

  function getVisibleItems() {
    return Array.from(document.querySelectorAll('.gal-item:not(.hidden)'));
  }

  function openLightbox(item) {
    visibleItems = getVisibleItems();
    currentIndex = visibleItems.indexOf(item);
    renderLightbox();
    lightbox.classList.add('open');
  }

  function renderLightbox() {
    const item = visibleItems[currentIndex];
    const img = item.querySelector('img');
    lbImage.src = img.src.replace('w=500', 'w=1000');
    lbImage.alt = img.alt;
    lbCaption.textContent = item.dataset.caption;
    lbDate.textContent = item.dataset.date;
  }

  galItems.forEach(item => {
    item.addEventListener('click', () => openLightbox(item));
  });

  lbClose.addEventListener('click', () => lightbox.classList.remove('open'));
  lightbox.addEventListener('click', (e) => { if (e.target === lightbox) lightbox.classList.remove('open'); });
  lbPrev.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
    renderLightbox();
  });
  lbNext.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % visibleItems.length;
    renderLightbox();
  });
  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('open')) return;
    if (e.key === 'Escape') lightbox.classList.remove('open');
    if (e.key === 'ArrowLeft') lbPrev.click();
    if (e.key === 'ArrowRight') lbNext.click();
  });
</script>
@endpush
