@extends('layouts.app')

@section('title', 'Video Pembahasan Soal & Materi Belajar — Bimbel Smart')
@section('page', 'video')

@push('styles')
<style>
  /* ============ PAGE BANNER ============ */
  .banner {
    padding: 76px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
    background: linear-gradient(180deg, var(--blue-tint) 0%, #fff 88%);
  }
  .banner-float {
    position: absolute;
    font-weight: 700;
    font-size: 13px;
    color: var(--blue);
    background: #fff;
    border: 1.5px solid var(--line);
    padding: 8px 16px;
    border-radius: 100px;
    opacity: .75;
    box-shadow: var(--shadow);
  }
  .banner-float.f1 { top: 18%; left: 6%; transform: rotate(-8deg); }
  .banner-float.f2 { top: 13%; right: 7%; transform: rotate(7deg); }
  .banner-float.f3 { bottom: 16%; left: 10%; transform: rotate(6deg); }
  .banner-float.f4 { bottom: 20%; right: 6%; transform: rotate(-6deg); }

  .breadcrumb {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    color: var(--ink-soft);
    margin-bottom: 22px;
    position: relative;
    z-index: 2;
  }
  .breadcrumb a { font-weight: 600; color: var(--ink-soft); }
  .breadcrumb .current { font-weight: 700; color: var(--gold-deep); }

  .banner h1 {
    position: relative;
    z-index: 2;
    font-size: clamp(30px, 4vw, 44px);
    max-width: 700px;
    margin: 0 auto 16px;
  }
  .banner p.lead {
    position: relative;
    z-index: 2;
    color: var(--ink-soft);
    max-width: 560px;
    margin: 0 auto 34px;
    font-size: 16.5px;
  }

  .search-box {
    position: relative;
    z-index: 2;
    max-width: 500px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 100px;
    padding: 6px 8px 6px 22px;
    box-shadow: var(--shadow);
  }
  .search-box svg { width: 19px; height: 19px; color: var(--ink-soft); flex-shrink: 0; }
  .search-box input {
    flex: 1;
    border: none;
    background: transparent;
    font-family: inherit;
    font-size: 14.5px;
    padding: 10px 0;
  }
  .search-box input:focus { outline: none; }
  .search-box button {
    background: var(--gold);
    color: var(--blue-deep);
    font-weight: 700;
    font-size: 14px;
    padding: 11px 22px;
    border-radius: 100px;
    flex-shrink: 0;
    transition: background .2s ease;
  }
  .search-box button:hover { background: var(--gold-deep); }

  /* ============ FEATURED VIDEO ============ */
  .featured-video { padding: 40px 0 20px; }
  .featured-card {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    background: linear-gradient(145deg, var(--blue-deep), var(--blue));
    border-radius: var(--radius-lg);
    overflow: hidden;
    color: #fff;
    box-shadow: var(--shadow);
  }
  .featured-media {
    position: relative;
    min-height: 360px;
    cursor: pointer;
    overflow: hidden;
    background: #0b102d;
  }
  .featured-media img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .45s ease, opacity .3s ease;
    opacity: .88;
  }
  .featured-media:hover img { transform: scale(1.05); opacity: .75; }
  .featured-media::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10, 14, 40, .15) 0%, rgba(10, 14, 40, .65) 100%);
  }
  .featured-media .tag {
    position: absolute;
    top: 20px;
    left: 20px;
    background: var(--gold);
    color: var(--blue-deep);
    font-size: 12px;
    font-weight: 800;
    padding: 6px 14px;
    border-radius: 100px;
    text-transform: uppercase;
    letter-spacing: .04em;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .featured-media .duration-pill {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: rgba(10, 14, 40, .82);
    color: #fff;
    font-size: 12.5px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 8px;
    z-index: 3;
    backdrop-filter: blur(4px);
  }

  /* Play Button Overlay */
  .play-trigger-circle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 74px;
    height: 74px;
    border-radius: 50%;
    background: var(--gold);
    color: var(--blue-deep);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    box-shadow: 0 0 0 12px rgba(255, 183, 3, .24), 0 15px 35px rgba(0, 0, 0, .35);
    transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
  }
  .play-trigger-circle svg {
    width: 28px;
    height: 28px;
    margin-left: 3px;
  }
  .featured-media:hover .play-trigger-circle {
    transform: translate(-50%, -50%) scale(1.1);
    background: #fff;
    box-shadow: 0 0 0 16px rgba(255, 255, 255, .22), 0 18px 40px rgba(0, 0, 0, .45);
  }

  .featured-body {
    padding: 44px 42px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .featured-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
  }
  .featured-badges span {
    font-size: 12px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 100px;
    background: rgba(255, 255, 255, .14);
    color: #FFD877;
  }
  .featured-body h2 {
    color: #fff;
    font-size: clamp(22px, 2.6vw, 29px);
    margin-bottom: 14px;
    line-height: 1.25;
  }
  .featured-body p.excerpt {
    color: rgba(255, 255, 255, .82);
    font-size: 15px;
    margin-bottom: 22px;
    line-height: 1.65;
  }
  .featured-tutor {
    font-size: 13.5px;
    color: rgba(255, 255, 255, .75);
    margin-bottom: 26px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
  }
  .featured-tutor strong { color: #fff; }

  /* ============ FILTER + VIDEO GRID ============ */
  .videolist { padding: 48px 0 100px; }
  .filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 40px;
  }
  .filter-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }
  .filter-pill {
    padding: 10px 20px;
    border-radius: 100px;
    border: 1.5px solid var(--line);
    font-weight: 700;
    font-size: 13.5px;
    color: var(--ink-soft);
    background: #fff;
    transition: all .2s ease;
  }
  .filter-pill:hover { border-color: var(--blue); color: var(--blue); }
  .filter-pill.active { background: var(--blue); border-color: var(--blue); color: #fff; }

  .grade-select {
    padding: 10px 18px;
    border-radius: 100px;
    border: 1.5px solid var(--line);
    font-family: inherit;
    font-weight: 700;
    font-size: 13.5px;
    color: var(--ink);
    background: var(--blue-tint);
    cursor: pointer;
  }
  .grade-select:focus { outline: none; border-color: var(--blue); }

  .video-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
  }
  .video-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--radius-md);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .24s ease, box-shadow .24s ease;
    cursor: pointer;
  }
  .video-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow);
  }
  .video-card.hidden { display: none; }

  .video-thumb {
    position: relative;
    aspect-ratio: 16 / 9;
    background: #0f172a;
    overflow: hidden;
  }
  .video-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease, opacity .3s ease;
  }
  .video-card:hover .video-thumb img {
    transform: scale(1.06);
    opacity: .88;
  }
  .video-thumb-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10, 14, 40, .1) 30%, rgba(10, 14, 40, .65) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .card-play-btn {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .94);
    color: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .28);
    transition: transform .25s ease, background .25s ease, color .25s ease;
  }
  .card-play-btn svg {
    width: 22px;
    height: 22px;
    margin-left: 2px;
  }
  .video-card:hover .card-play-btn {
    transform: scale(1.12);
    background: var(--gold);
    color: var(--blue-deep);
  }

  .video-thumb .cat-tag {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(255, 255, 255, .95);
    color: var(--blue);
    font-size: 11.5px;
    font-weight: 800;
    padding: 5px 12px;
    border-radius: 100px;
    text-transform: uppercase;
    letter-spacing: .03em;
    z-index: 2;
  }
  .video-thumb .grade-tag {
    position: absolute;
    top: 14px;
    right: 14px;
    background: var(--blue);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 100px;
    z-index: 2;
  }
  .video-thumb .dur-tag {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(10, 14, 40, .82);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 6px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .video-body {
    padding: 22px 22px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .video-meta {
    font-size: 12.5px;
    color: var(--ink-soft);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    font-weight: 600;
  }
  .video-meta .dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--ink-soft);
  }
  .video-body h3 {
    font-size: 17.5px;
    margin-bottom: 10px;
    line-height: 1.35;
    color: var(--ink);
    transition: color .2s;
  }
  .video-card:hover .video-body h3 { color: var(--blue); }
  .video-body p {
    font-size: 14px;
    color: var(--ink-soft);
    margin-bottom: 18px;
    flex-grow: 1;
  }
  .video-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    font-size: 14px;
    color: var(--blue);
    margin-top: auto;
  }
  .video-action svg {
    width: 17px;
    height: 17px;
    transition: transform .2s ease;
  }
  .video-card:hover .video-action svg { transform: translateX(4px); }

  .empty-state {
    display: none;
    text-align: center;
    padding: 60px 20px;
    color: var(--ink-soft);
    background: var(--blue-tint);
    border-radius: var(--radius-md);
  }
  .empty-state.show { display: block; }

  /* ============ VIDEO MODAL PLAYER ============ */
  .video-modal {
    position: fixed;
    inset: 0;
    background: rgba(10, 14, 40, .9);
    backdrop-filter: blur(6px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    overflow-y: auto;
  }
  .video-modal.open { display: flex; }
  .video-modal-dialog {
    position: relative;
    max-width: 920px;
    width: 100%;
    background: #fff;
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: 0 30px 60px -15px rgba(0, 0, 0, .6);
    animation: modalPop .28s cubic-bezier(0.18, 0.89, 0.32, 1.15);
  }
  @keyframes modalPop {
    from { opacity: 0; transform: scale(.94) translateY(12px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
  }
  .vm-top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 22px;
    background: var(--blue-deep);
    color: #fff;
  }
  .vm-top-badges {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }
  .vm-badge {
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 100px;
    background: rgba(255, 255, 255, .14);
    color: #FFD877;
  }
  .vm-close {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .14);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s ease, transform .2s ease;
  }
  .vm-close:hover {
    background: #ef4444;
    transform: rotate(90deg);
  }
  .vm-close svg { width: 18px; height: 18px; }

  .vm-player-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #000;
  }
  .vm-player-wrap iframe,
  .vm-player-wrap video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: none;
  }

  .vm-info {
    padding: 24px 28px;
    background: #fff;
  }
  .vm-info-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 10px;
    flex-wrap: wrap;
  }
  .vm-info h3 {
    font-size: clamp(19px, 2.4vw, 23px);
    color: var(--ink);
  }
  .vm-tutor {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--blue);
    background: var(--blue-tint);
    padding: 6px 14px;
    border-radius: 100px;
    white-space: nowrap;
  }
  .vm-desc {
    color: var(--ink-soft);
    font-size: 14.5px;
    line-height: 1.65;
    margin-bottom: 20px;
    white-space: pre-line;
  }
  .vm-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--line);
    flex-wrap: wrap;
  }
  .vm-nav-btns {
    display: flex;
    gap: 10px;
  }
  .vm-nav-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 100px;
    border: 1.5px solid var(--line);
    font-weight: 700;
    font-size: 13px;
    color: var(--ink);
    background: #fff;
    transition: all .2s ease;
  }
  .vm-nav-btn:hover {
    border-color: var(--blue);
    color: var(--blue);
    background: var(--blue-tint);
  }
  .vm-nav-btn svg { width: 15px; height: 15px; }

  /* ============ CTA ============ */
  .cta { padding: 0 0 110px; }
  .cta-card {
    background: linear-gradient(155deg, var(--blue-deep), var(--blue));
    border-radius: var(--radius-lg);
    padding: 60px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
  }
  .cta-card::before {
    content: '';
    position: absolute;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: rgba(255, 183, 3, .14);
    top: -140px;
    right: -80px;
  }
  .cta-card h2 {
    color: #fff;
    font-size: clamp(24px, 3.2vw, 32px);
    margin-bottom: 12px;
    position: relative;
  }
  .cta-card p {
    color: rgba(255, 255, 255, .82);
    max-width: 500px;
    margin: 0 auto 28px;
    position: relative;
  }
  .cta-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    position: relative;
  }

  /* ============ RESPONSIVE ============ */
  @media (max-width: 980px) {
    .banner-float { display: none; }
    .featured-card { grid-template-columns: 1fr; }
    .featured-media { min-height: 260px; }
    .featured-body { padding: 30px 26px; }
    .video-grid { grid-template-columns: repeat(2, 1fr); }
    .cta-card { padding: 40px 26px; }
  }
  @media (max-width: 560px) {
    .banner { padding: 56px 0 44px; }
    .search-box { flex-wrap: wrap; padding: 14px 16px; border-radius: var(--radius-md); }
    .search-box input { width: 100%; order: 1; }
    .search-box svg { order: 0; }
    .search-box button { order: 2; width: 100%; }
    .video-grid { grid-template-columns: 1fr; }
    .filter-row { overflow-x: auto; flex-wrap: nowrap; padding-bottom: 6px; width: 100%; }
    .vm-info { padding: 18px 18px 22px; }
    .vm-footer { flex-direction: column; align-items: stretch; }
    .vm-nav-btns { justify-content: space-between; }
  }
</style>
@endpush

@section('content')
<!-- ============ PAGE BANNER ============ -->
<section class="banner">
  <span class="banner-float f1">#PembahasanSoal</span>
  <span class="banner-float f2">#TrikCepatUTBK</span>
  <span class="banner-float f3">#BelajarSeru</span>
  <span class="banner-float f4">#BimbelSmart</span>
  <div class="wrap">
    <div class="breadcrumb reveal">
      <a href="{{ route('home') }}#home">Home</a>
      <span>/</span>
      <span class="current">Video Belajar</span>
    </div>
    <h1 class="reveal">Video Pembahasan Soal &amp; Materi Belajar</h1>
    <p class="lead reveal">Tonton potongan pembahasan soal, trik cepat menjawab ujian, dan materi pilihan dari tutor berpengalaman Bimbel Smart.</p>
    <div class="search-box reveal">
      <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8"/><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      <input type="text" id="searchInput" placeholder="Cari pembahasan soal, misal 'Matematika' atau 'UTBK'...">
      <button type="button" id="searchBtn">Cari</button>
    </div>
  </div>
</section>

<!-- ============ FEATURED VIDEO HIGHLIGHT ============ -->
@if($featured)
<section class="featured-video">
  <div class="wrap">
    <div class="featured-card reveal">
      <div class="featured-media js-open-featured"
           role="button"
           tabindex="0"
           aria-label="Putar {{ $featured->title }}"
           data-id="{{ $featured->id }}">
        <img src="{{ $featured->thumbnail_url }}" alt="{{ $featured->title }}">
        <span class="tag">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Video Pilihan
        </span>
        <div class="play-trigger-circle">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
        </div>
        @if($featured->duration)
          <span class="duration-pill">{{ $featured->duration }}</span>
        @endif
      </div>
      <div class="featured-body">
        <div class="featured-badges">
          <span>{{ $featured->category }}</span>
          @if($featured->grade_level)
            <span>Jenjang {{ $featured->grade_level }}</span>
          @endif
        </div>
        <h2>{{ $featured->title }}</h2>
        @if($featured->description)
          <p class="excerpt">{{ \Illuminate\Support\Str::limit($featured->description, 180) }}</p>
        @endif
        @if($featured->tutor_name)
          <div class="featured-tutor">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="4" stroke="#FFD877" stroke-width="2"/><path d="M4 20c1.8-3.5 5-5 8-5s6.2 1.5 8 5" stroke="#FFD877" stroke-width="2" stroke-linecap="round"/></svg>
            <span>Dibahas oleh <strong>{{ $featured->tutor_name }}</strong></span>
          </div>
        @endif
        <div>
          <button type="button" class="btn btn-primary js-open-featured" data-id="{{ $featured->id }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
            Tonton Pembahasan Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<!-- ============ FILTER + VIDEO CATALOG GRID ============ -->
<section class="videolist">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Koleksi Video</span>
      <h2>Pilih Materi &amp; Pembahasan Soal</h2>
      <p>Klik pada kartu video untuk langsung memutar pembahasan soal di layar kamu.</p>
    </div>

    <div class="filter-bar reveal">
      <div class="filter-row" id="categoryFilters">
        <button type="button" class="filter-pill active" data-filter="semua">Semua Materi</button>
        @foreach($categories as $cat)
          <button type="button" class="filter-pill" data-filter="{{ $cat }}">{{ $cat }}</button>
        @endforeach
      </div>

      @if($gradeLevels->count() > 1)
        <select id="gradeFilter" class="grade-select" aria-label="Filter Jenjang Pendidikan">
          <option value="semua">Semua Jenjang</option>
          @foreach($gradeLevels as $grade)
            <option value="{{ $grade }}">Jenjang: {{ $grade }}</option>
          @endforeach
        </select>
      @endif
    </div>

    <div class="video-grid reveal" id="videoGrid">
      @forelse($videos as $video)
        <article class="video-card"
                 data-id="{{ $video->id }}"
                 data-title="{{ $video->title }}"
                 data-search="{{ \Illuminate\Support\Str::lower($video->title . ' ' . $video->category . ' ' . $video->tutor_name . ' ' . $video->description) }}"
                 data-category="{{ $video->category }}"
                 data-grade="{{ $video->grade_level ?? 'Umum' }}"
                 data-tutor="{{ $video->tutor_name ?? 'Tutor Bimbel Smart' }}"
                 data-duration="{{ $video->duration ?? '' }}"
                 data-description="{{ $video->description ?? '' }}"
                 data-source="{{ $video->video_source }}"
                 data-embed="{{ $video->embed_url ?? '' }}"
                 data-file="{{ $video->video_file_url ?? '' }}"
                 data-youtube-raw="{{ $video->youtube_url ?? '' }}">
          <div class="video-thumb">
            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" loading="lazy">
            <span class="cat-tag">{{ $video->category }}</span>
            @if($video->grade_level)
              <span class="grade-tag">{{ $video->grade_level }}</span>
            @endif
            <div class="video-thumb-overlay">
              <div class="card-play-btn" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
              </div>
            </div>
            @if($video->duration)
              <span class="dur-tag">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                {{ $video->duration }}
              </span>
            @endif
          </div>

          <div class="video-body">
            <div class="video-meta">
              @if($video->published_at)
                <span>{{ $video->published_at->translatedFormat('d M Y') }}</span>
              @endif
              @if($video->published_at && $video->tutor_name)
                <span class="dot"></span>
              @endif
              @if($video->tutor_name)
                <span>{{ $video->tutor_name }}</span>
              @endif
            </div>
            <h3>{{ $video->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($video->description ?: 'Tonton video pembahasan soal lengkap bersama tutor Bimbel Smart.', 105) }}</p>
            <span class="video-action">
              Putar Video Pembahasan
              <svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
          </div>
        </article>
      @empty
        <p style="grid-column: 1 / -1; text-align: center; color: var(--ink-soft); padding: 40px 0;">Belum ada video pembelajaran yang dipublikasikan.</p>
      @endforelse
    </div>

    <div class="empty-state" id="emptyState">
      <strong style="display:block;font-size:17px;color:var(--ink);margin-bottom:6px;">Video tidak ditemukan</strong>
      <span>Belum ada video pembahasan yang cocok dengan kata kunci atau filter yang dipilih.</span>
    </div>
  </div>
</section>

<!-- ============ MODAL VIDEO PLAYER ============ -->
<div class="video-modal" id="videoModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="video-modal-dialog">
    <div class="vm-top-bar">
      <div class="vm-top-badges">
        <span class="vm-badge" id="modalCategory">Kategori</span>
        <span class="vm-badge" id="modalGrade">Jenjang</span>
        <span class="vm-badge" id="modalDuration" style="display:none;"></span>
      </div>
      <button type="button" class="vm-close" id="modalCloseBtn" aria-label="Tutup pemutar video">
        <svg viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
      </button>
    </div>

    <div class="vm-player-wrap" id="modalPlayerContainer">
      <!-- Iframe YouTube atau HTML5 Video di-render secara dinamis saat modal dibuka -->
    </div>

    <div class="vm-info">
      <div class="vm-info-header">
        <h3 id="modalTitle">Judul Video</h3>
        <span class="vm-tutor" id="modalTutor">Tutor Bimbel Smart</span>
      </div>
      <p class="vm-desc" id="modalDescription"></p>

      <div class="vm-footer">
        <div class="vm-nav-btns">
          <button type="button" class="vm-nav-btn" id="modalPrevBtn">
            <svg viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Video Sebelumnya
          </button>
          <button type="button" class="vm-nav-btn" id="modalNextBtn">
            Video Selanjutnya
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
        <a href="{{ route('kontak') }}#form-kontak" class="btn btn-primary btn-sm">
          Daftar Kelas Privat / Reguler
        </a>
      </div>
    </div>
  </div>
</div>

<!-- ============ CTA SECTION ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Ingin Dibimbing Langsung Membahas Soal Sulit?</h2>
      <p>Gabung bersama Bimbel Smart dan dapatkan bimbingan intensif bersama tutor lulusan universitas terbaik dengan metode yang seru dan mudah dipahami.</p>
      <div class="cta-actions">
        <a href="{{ route('kontak') }}#form-kontak" class="btn btn-primary">Daftar Sekarang</a>
        <a href="{{ route('layanan') }}" class="btn btn-outline-light">Lihat Program Belajar</a>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const filterPills = document.querySelectorAll('#categoryFilters .filter-pill');
  const gradeSelect = document.getElementById('gradeFilter');
  const searchInput = document.getElementById('searchInput');
  const searchBtn = document.getElementById('searchBtn');
  const cards = Array.from(document.querySelectorAll('.video-card'));
  const emptyState = document.getElementById('emptyState');

  let activeCategory = 'semua';
  let activeGrade = 'semua';

  function applyFilters() {
    const query = (searchInput?.value || '').trim().toLowerCase();
    let visibleCount = 0;

    cards.forEach(card => {
      const matchCat = activeCategory === 'semua' || card.dataset.category === activeCategory;
      const matchGrade = activeGrade === 'semua' || card.dataset.grade === activeGrade;
      const matchSearch = query === '' || (card.dataset.search || '').includes(query);

      const show = matchCat && matchGrade && matchSearch;
      card.classList.toggle('hidden', !show);
      if (show) visibleCount++;
    });

    if (emptyState) {
      emptyState.classList.toggle('show', visibleCount === 0 && cards.length > 0);
    }
  }

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');
      activeCategory = pill.dataset.filter;
      applyFilters();
    });
  });

  if (gradeSelect) {
    gradeSelect.addEventListener('change', () => {
      activeGrade = gradeSelect.value;
      applyFilters();
    });
  }

  if (searchBtn) searchBtn.addEventListener('click', applyFilters);
  if (searchInput) {
    searchInput.addEventListener('input', applyFilters);
  }

  // ============ MODAL VIDEO PLAYER LOGIC ============
  const modal = document.getElementById('videoModal');
  const playerContainer = document.getElementById('modalPlayerContainer');
  const modalTitle = document.getElementById('modalTitle');
  const modalCategory = document.getElementById('modalCategory');
  const modalGrade = document.getElementById('modalGrade');
  const modalDuration = document.getElementById('modalDuration');
  const modalTutor = document.getElementById('modalTutor');
  const modalDescription = document.getElementById('modalDescription');
  const closeBtn = document.getElementById('modalCloseBtn');
  const prevBtn = document.getElementById('modalPrevBtn');
  const nextBtn = document.getElementById('modalNextBtn');

  let currentList = [];
  let currentIndex = 0;

  function getVisibleCards() {
    const vis = cards.filter(c => !c.classList.contains('hidden'));
    return vis.length > 0 ? vis : cards;
  }

  function renderPlayer(card) {
    if (!card) return;

    modalTitle.textContent = card.dataset.title || '';
    modalCategory.textContent = card.dataset.category || 'Materi';
    modalGrade.textContent = card.dataset.grade ? 'Jenjang ' + card.dataset.grade : 'Semua Jenjang';

    if (card.dataset.duration) {
      modalDuration.style.display = 'inline-block';
      modalDuration.textContent = card.dataset.duration;
    } else {
      modalDuration.style.display = 'none';
    }

    modalTutor.textContent = card.dataset.tutor || 'Tutor Bimbel Smart';
    modalDescription.textContent = card.dataset.description || 'Pembahasan soal dan materi bersama tutor Bimbel Smart.';

    // Bersihkan player sebelumnya
    playerContainer.innerHTML = '';

    const source = card.dataset.source;
    const embedUrl = card.dataset.embed;
    const fileUrl = card.dataset.file;

    if (source === 'upload' && fileUrl) {
      const videoEl = document.createElement('video');
      videoEl.src = fileUrl;
      videoEl.controls = true;
      videoEl.autoplay = true;
      videoEl.playsInline = true;
      playerContainer.appendChild(videoEl);
    } else if (embedUrl) {
      const iframe = document.createElement('iframe');
      iframe.src = embedUrl;
      iframe.title = card.dataset.title || 'Video Pembelajaran';
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
      iframe.allowFullscreen = true;
      playerContainer.appendChild(iframe);
    } else {
      playerContainer.innerHTML = `
        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:#fff;padding:24px;text-align:center;">
          <p style="margin-bottom:14px;opacity:.85;">Video siap ditonton melalui tautan berikut:</p>
          <a href="${card.dataset.youtubeRaw || '#'}" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Buka Video</a>
        </div>
      `;
    }
  }

  function openModalWithCard(card) {
    currentList = getVisibleCards();
    currentIndex = currentList.indexOf(card);
    if (currentIndex === -1) {
      currentList = cards;
      currentIndex = currentList.indexOf(card);
    }
    renderPlayer(currentList[currentIndex]);
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.remove('open');
    playerContainer.innerHTML = ''; // Hentikan pemutaran video/suara
    document.body.style.overflow = '';
  }

  cards.forEach(card => {
    card.addEventListener('click', () => openModalWithCard(card));
  });

  // Tombol pada Featured Video di atas
  document.querySelectorAll('.js-open-featured').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const targetId = trigger.dataset.id;
      const matchingCard = cards.find(c => c.dataset.id === targetId) || cards[0];
      if (matchingCard) openModalWithCard(matchingCard);
    });
  });

  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  prevBtn.addEventListener('click', () => {
    if (!currentList.length) return;
    currentIndex = (currentIndex - 1 + currentList.length) % currentList.length;
    renderPlayer(currentList[currentIndex]);
  });

  nextBtn.addEventListener('click', () => {
    if (!currentList.length) return;
    currentIndex = (currentIndex + 1) % currentList.length;
    renderPlayer(currentList[currentIndex]);
  });

  document.addEventListener('keydown', (e) => {
    if (!modal.classList.contains('open')) return;
    if (e.key === 'Escape') closeModal();
    if (e.key === 'ArrowLeft') prevBtn.click();
    if (e.key === 'ArrowRight') nextBtn.click();
  });
});
</script>
@endpush
