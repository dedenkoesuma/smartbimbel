@extends('layouts.app')

@php
  $categoryLabels = [
    'tips' => 'Tips Belajar',
    'info' => 'Info Pendidikan',
    'sukses' => 'Cerita Sukses',
    'english' => 'English Corner',
    'parenting' => 'Parenting',
  ];
@endphp

@section('title', $post->title.' — Bimbel Smart')
@section('page', 'blog')

@push('styles')
<style>
  /* ============ POST BANNER ============ */
  .post-banner{
    padding:64px 0 54px;text-align:center;position:relative;overflow:hidden;
    background:linear-gradient(180deg,var(--blue-tint) 0%, #fff 85%);
  }
  .breadcrumb{display:flex;justify-content:center;flex-wrap:wrap;gap:8px;font-size:13.5px;color:var(--ink-soft);margin-bottom:20px;}
  .breadcrumb a{font-weight:600;color:var(--ink-soft);}
  .breadcrumb .current{font-weight:700;color:var(--gold-deep);}
  .post-tag{
    display:inline-block;background:var(--blue);color:#fff;font-size:12px;font-weight:800;
    padding:7px 16px;border-radius:100px;text-transform:uppercase;letter-spacing:.03em;margin-bottom:18px;
  }
  .post-banner h1{font-size:clamp(26px,3.6vw,40px);max-width:760px;margin:0 auto 18px;}
  .post-meta{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;align-items:center;font-size:13.5px;color:var(--ink-soft);font-weight:600;}
  .post-meta .dot{width:4px;height:4px;border-radius:50%;background:var(--ink-soft);}

  /* ============ POST BODY LAYOUT ============ */
  .post-body{padding:56px 0 100px;}
  .post-layout{display:grid;grid-template-columns:1fr .38fr;gap:48px;align-items:start;}
  .post-cover{border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow);margin-bottom:40px;}
  .post-cover img{width:100%;max-height:440px;object-fit:cover;display:block;}
  .post-text p{font-size:16px;line-height:1.85;color:var(--ink);margin-bottom:22px;}
  .post-text p:last-child{margin-bottom:0;}
  .post-text strong{color:var(--blue-deep);}
  .post-text em{color:var(--ink-soft);}

  .post-share{
    display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-top:40px;padding-top:28px;border-top:1px solid var(--line);
  }
  .post-share span{font-size:13.5px;font-weight:700;color:var(--ink-soft);}
  .post-share .share-links{display:flex;gap:10px;}
  .post-share a, .post-share button{
    width:40px;height:40px;border-radius:50%;background:var(--blue-tint);border:1px solid var(--line);
    display:flex;align-items:center;justify-content:center;transition:background .2s, transform .2s;
  }
  .post-share a:hover, .post-share button:hover{background:var(--gold);transform:translateY(-3px);}
  .post-share svg{width:17px;height:17px;color:var(--blue);}

  .post-author{
    display:flex;gap:16px;align-items:center;background:var(--blue-tint);border-radius:var(--radius-md);
    padding:22px 26px;margin-top:32px;
  }
  .post-author .avatar{
    width:52px;height:52px;border-radius:50%;background:var(--blue);color:#fff;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:19px;font-weight:700;
  }
  .post-author strong{display:block;font-size:14.5px;margin-bottom:2px;}
  .post-author span{font-size:13px;color:var(--ink-soft);}

  .post-back{margin-top:36px;}

  /* ============ SIDEBAR ============ */
  .post-sidebar{display:grid;gap:22px;position:sticky;top:24px;}
  .sidebar-box{background:#fff;border:1px solid var(--line);border-radius:var(--radius-md);padding:24px;}
  .sidebar-box h4{font-size:15px;margin-bottom:16px;}
  .cat-list{display:grid;gap:8px;}
  .cat-list a{
    display:flex;justify-content:space-between;font-size:13.5px;font-weight:600;color:var(--ink-soft);
    padding:9px 12px;border-radius:10px;transition:background .2s, color .2s;
  }
  .cat-list a:hover{background:var(--blue-tint);color:var(--blue);}
  .related-list{display:grid;gap:16px;}
  .related-item{display:flex;gap:12px;align-items:flex-start;}
  .related-item .thumb{width:64px;height:64px;border-radius:10px;overflow:hidden;flex-shrink:0;}
  .related-item .thumb img{width:100%;height:100%;object-fit:cover;}
  .related-item h5{font-size:13.5px;line-height:1.4;margin-bottom:4px;}
  .related-item span{font-size:12px;color:var(--ink-soft);}
  .sidebar-cta{
    background:linear-gradient(155deg,var(--blue-deep),var(--blue));border-radius:var(--radius-md);
    padding:26px 22px;color:#fff;text-align:center;
  }
  .sidebar-cta h4{color:#fff;font-size:16px;margin-bottom:8px;}
  .sidebar-cta p{color:rgba(255,255,255,.78);font-size:13px;margin-bottom:18px;}

  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .post-layout{grid-template-columns:1fr;}
    .post-sidebar{position:static;grid-template-columns:1fr 1fr;}
  }
  @media (max-width:560px){
    .post-banner{padding:48px 0 40px;}
    .post-sidebar{grid-template-columns:1fr;}
    .post-author{flex-direction:column;text-align:center;}
    .post-share{flex-direction:column;align-items:flex-start;}
  }
</style>
@endpush

@section('content')

<!-- ============ POST BANNER ============ -->
<section class="post-banner">
  <div class="wrap">
    <div class="breadcrumb reveal">
      <a href="{{ route('home') }}#home">Home</a><span>/</span>
      <a href="{{ route('blog') }}">Blog</a><span>/</span>
      <span class="current">{{ $categoryLabels[$post->category] ?? 'Artikel' }}</span>
    </div>
    <span class="post-tag reveal">{{ $categoryLabels[$post->category] ?? 'Artikel' }}</span>
    <h1 class="reveal">{{ $post->title }}</h1>
    <div class="post-meta reveal">
      <span>{{ $post->published_at?->translatedFormat('d M Y') }}</span><span class="dot"></span><span>{{ $post->read_time }} min baca</span>
    </div>
  </div>
</section>

<!-- ============ POST BODY ============ -->
<section class="post-body">
  <div class="wrap post-layout">
    <article class="reveal">
      <div class="post-cover">
        <img src="{{ $post->getFirstMediaUrl('post_images') }}" alt="{{ $post->title }}">
      </div>
      <div class="post-text">
        {!! $post->content !!}
      </div>

      <div class="post-share">
        <span>Bagikan artikel:</span>
        <div class="share-links">
          <a href="https://wa.me/?text={{ urlencode($post->title.' - '.request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
            <svg viewBox="0 0 24 24" fill="none"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.7a2 2 0 01-.5 2.1L8 9.7a16 16 0 006.3 6.3l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.5 2.7.6a2 2 0 011.7 2.1z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
            <svg viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3c-1.7 0-3 1.3-3 3v2H9v3h2v6h3v-6h3l1-3h-4V9c0-.6.4-1 1-1z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
          </a>
          <button type="button" id="copyLinkBtn" aria-label="Salin tautan">
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 12a4 4 0 004 4h1a4 4 0 000-8h-1M15 12a4 4 0 00-4-4H10a4 4 0 000 8h1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
          </button>
        </div>
      </div>

      <div class="post-author">
        <div class="avatar">BS</div>
        <div>
          <strong>Tim Editorial Bimbel Smart</strong>
          <span>Ditulis oleh tutor & tim pengajar Bimbel Smart</span>
        </div>
      </div>

      <div class="post-back">
        <a href="{{ route('blog') }}" class="link-arrow">
          <svg viewBox="0 0 24 24" fill="none" style="transform:rotate(180deg)"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kembali ke Semua Artikel
        </a>
      </div>
    </article>

    <aside class="post-sidebar reveal">
      <div class="sidebar-box">
        <h4>Kategori</h4>
        <div class="cat-list">
          @foreach ($categoryLabels as $key => $label)
            <a href="{{ route('blog') }}">
              <span>{{ $label }}</span>
              @if($key === $post->category)
                <span style="color:var(--gold-deep);">●</span>
              @endif
            </a>
          @endforeach
        </div>
      </div>

      @if($related->count())
      <div class="sidebar-box">
        <h4>Artikel Terkait</h4>
        <div class="related-list">
          @foreach ($related as $item)
            <a href="{{ route('blog.show', $item->slug) }}" class="related-item">
              <div class="thumb"><img src="{{ $item->getFirstMediaUrl('post_images') }}" alt="{{ $item->title }}"></div>
              <div>
                <h5>{{ $item->title }}</h5>
                <span>{{ $item->published_at?->translatedFormat('d M Y') }}</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
      @endif

      <div class="sidebar-cta">
        <h4>Masih Bingung Pilih Program?</h4>
        <p>Konsultasi gratis sama tim kami, biar dapat rekomendasi yang paling cocok.</p>
        <a href="{{ route('kontak') }}" class="btn btn-primary btn-block">Konsultasi Gratis</a>
      </div>
    </aside>
  </div>
</section>

@endsection

@push('scripts')
<script>
  const copyLinkBtn = document.getElementById('copyLinkBtn');
  if (copyLinkBtn) {
    copyLinkBtn.addEventListener('click', () => {
      navigator.clipboard.writeText(window.location.href).then(() => {
        const original = copyLinkBtn.innerHTML;
        copyLinkBtn.innerHTML = '<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        setTimeout(() => { copyLinkBtn.innerHTML = original; }, 1600);
      });
    });
  }
</script>
@endpush