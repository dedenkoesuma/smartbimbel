<footer>
  <div class="wrap">
    <div class="footer-grid">
      <div class="footer-about">
        <div class="footer-logo">
          <img src="{{ asset('assets/logo-light.png') }}" alt="Logo Bimbel Smart" style="height: 50px; width: auto;">
        </div>
        <p>Bimbingan belajar terpercaya yang mengedepankan metode belajar menyenangkan dan hasil yang maksimal. Bergabunglah dengan ribuan siswa sukses lainnya.</p>
      </div>
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="{{ route('home') }}#home">Home</a></li>
          <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
          <li><a href="{{ route('layanan') }}">Layanan</a></li>
          <li><a href="{{ route('galeri') }}">Galeri</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Newsletter</h4>
        <p style="font-size:14px;margin-bottom:14px;">Dapatkan info promo dan tips belajar gratis.</p>
        <form class="newsletter-form" id="newsletterForm">
          <input type="email" placeholder="Email kamu" required>
          <button type="submit" aria-label="Subscribe"><svg viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">&copy; {{ date('Y') }} Bimbel Smart. All rights reserved.</div>
  </div>
</footer>