{{--
    PARTIAL: HEADER
    Dipanggil dari layouts/app.blade.php pakai @include('partials.header')
    Link nav pakai route() supaya otomatis ikut prefix/domain project.
--}}
<header>
  <nav>
    <a href="{{ route('home') }}#home" class="logo">
      <span class="logo-mark">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3L2 8l10 5 10-5-10-5z" stroke="#fff" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 11v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </span>
      Bimbel<span>Smart</span>
    </a>
    <div class="nav-links">
      <a href="{{ route('home') }}#home" data-nav="home">Home</a>
      <a href="{{ route('tentang-kami') }}" data-nav="tentang">Tentang Kami</a>
      <a href="{{ route('layanan') }}" data-nav="layanan">Layanan</a>
      <a href="{{ route('galeri') }}" data-nav="galeri">Galeri</a>
      <a href="{{ route('blog') }}" data-nav="blog">Blog</a>
      <a href="{{ route('kontak') }}" data-nav="kontak">Kontak</a>
    </div>
    <div class="nav-cta">
      <a href="{{ route('kontak') }}" class="btn btn-primary" style="padding:12px 24px;font-size:14px;">Daftar Sekarang</a>
      <button class="burger" id="burgerBtn" aria-label="Buka menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>
</header>

<div class="mobile-nav" id="mobileNav">
  <div class="mobile-nav-top">
    <a href="{{ route('home') }}#home" class="logo">Bimbel<span>Smart</span></a>
    <button class="burger" id="closeBtn" aria-label="Tutup menu">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6L6 18" stroke="#12193B" stroke-width="2" stroke-linecap="round"/></svg>
    </button>
  </div>
  <a href="{{ route('home') }}#home" class="mnav-link" data-nav="home">Home</a>
  <a href="{{ route('tentang-kami') }}" class="mnav-link" data-nav="tentang">Tentang Kami</a>
  <a href="{{ route('layanan') }}" class="mnav-link" data-nav="layanan">Layanan</a>
  <a href="{{ route('galeri') }}" class="mnav-link" data-nav="galeri">Galeri</a>
  <a href="{{ route('blog') }}" class="mnav-link" data-nav="blog">Blog</a>
  <a href="{{ route('kontak') }}" class="mnav-link" data-nav="kontak">Kontak</a>
  <a href="{{ route('kontak') }}" class="btn btn-primary btn-block">Daftar Sekarang</a>
</div>