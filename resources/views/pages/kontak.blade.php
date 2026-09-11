@extends('layouts.app')

@section('title', 'Kontak Kami — Bimbel Smart')
@section('page', 'kontak')

@push('styles')
<style>
  /* ============ PAGE BANNER (khusus Kontak) ============ */
  .banner{background:#fff;overflow:hidden;}
  .banner-inner{display:grid;grid-template-columns:1fr .95fr;min-height:420px;}
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
  .banner-copy h1{font-size:clamp(30px,3.6vw,42px);color:#fff;max-width:460px;margin-bottom:16px;}
  .banner-copy p.lead{color:rgba(255,255,255,.78);max-width:420px;font-size:16px;margin-bottom:0;}
  .banner-photo{position:relative;clip-path:polygon(14% 0, 100% 0, 100% 100%, 0% 100%);}
  .banner-photo img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
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

  /* ============ CONTACT ============ */
  .contact{padding:90px 0 30px;}
  .contact-card{background:linear-gradient(155deg,var(--blue-tint),#fff);border-radius:var(--radius-lg);padding:56px;display:grid;grid-template-columns:.85fr 1.15fr;gap:56px;box-shadow:var(--shadow);border:1px solid var(--line);}
  .contact-info h2{font-size:clamp(24px,3vw,30px);margin-bottom:12px;}
  .contact-info > p{color:var(--ink-soft);margin-bottom:32px;}
  .contact-row{display:flex;gap:14px;margin-bottom:22px;align-items:flex-start;}
  .contact-row .ic{width:42px;height:42px;border-radius:12px;background:var(--blue);flex-shrink:0;display:flex;align-items:center;justify-content:center;}
  .contact-row .ic svg{width:19px;height:19px;color:#fff;}
  .contact-row strong{display:block;font-size:14.5px;margin-bottom:3px;}
  .contact-row span{font-size:14px;color:var(--ink-soft);}
  .socials{display:flex;gap:10px;margin-top:8px;}
  .socials a{width:38px;height:38px;border-radius:50%;background:#fff;border:1px solid var(--line);display:flex;align-items:center;justify-content:center;transition:background .2s, transform .2s;}
  .socials a:hover{background:var(--gold);transform:translateY(-3px);}
  .socials a svg{width:17px;height:17px;color:var(--blue);}
  .contact-form{background:#fff;border-radius:var(--radius-md);padding:32px;box-shadow:var(--shadow);}
  .contact-form h3{font-size:19px;margin-bottom:22px;}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
  .field{display:flex;flex-direction:column;gap:8px;margin-bottom:16px;}
  .field.full{grid-column:1/-1;}
  .field label{font-size:13px;font-weight:700;color:var(--ink-soft);}
  .field input,.field select,.field textarea{border:1.5px solid var(--line);border-radius:12px;padding:13px 16px;font-family:inherit;font-size:14.5px;background:var(--blue-tint);transition:border-color .2s, background .2s;color:var(--ink);}
  .field input:focus,.field select:focus,.field textarea:focus{outline:none;border-color:var(--blue);background:#fff;}
  .field textarea{resize:vertical;min-height:110px;}
  .form-note{font-size:12.5px;color:var(--ink-soft);margin-top:4px;}
  .form-success{
    display:none;align-items:center;gap:10px;background:#EAF6EE;border:1px solid #BEE5C9;color:#1E7A3D;
    padding:12px 16px;border-radius:12px;font-size:13.5px;font-weight:600;margin-bottom:16px;
  }
  .form-success.show{display:flex;}
  .form-success svg{width:18px;height:18px;flex-shrink:0;}

  /* ============ MAP + JAM OPERASIONAL ============ */
  .map-hours{padding:0 0 100px;}
  .map-hours-grid{display:grid;grid-template-columns:1.4fr 1fr;gap:26px;}
  .map-box{border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow);position:relative;min-height:340px;border:1px solid var(--line);}
  .map-box iframe{width:100%;height:100%;min-height:340px;border:0;filter:grayscale(.15) contrast(1.02);}
  .map-pin{
    position:absolute;top:20px;left:20px;background:#fff;border-radius:100px;padding:10px 18px 10px 14px;
    display:flex;align-items:center;gap:8px;box-shadow:var(--shadow);font-weight:700;font-size:13.5px;color:var(--blue);
  }
  .map-pin svg{width:16px;height:16px;color:var(--gold-deep);flex-shrink:0;}
  .hours-card{background:var(--blue-deep);border-radius:var(--radius-lg);padding:38px 34px;color:#fff;position:relative;overflow:hidden;}
  .hours-card::before{content:'';position:absolute;width:220px;height:220px;border-radius:50%;background:rgba(255,183,3,.14);top:-100px;right:-70px;}
  .hours-card h3{color:#fff;font-size:20px;margin-bottom:20px;position:relative;display:flex;align-items:center;gap:10px;}
  .hours-card h3 svg{width:20px;height:20px;color:#FFD877;}
  .hours-list{display:grid;gap:0;position:relative;}
  .hours-row{display:flex;justify-content:space-between;padding:13px 0;border-bottom:1px solid rgba(255,255,255,.12);font-size:14px;}
  .hours-row:last-child{border-bottom:none;}
  .hours-row span:first-child{color:rgba(255,255,255,.75);font-weight:600;}
  .hours-row span:last-child{font-weight:700;}
  .hours-row.off span:last-child{color:#FFD877;}

  /* ============ FAQ ============ */
  .faq{padding:0 0 100px;background:var(--blue-tint);padding-top:90px;}
  .faq-list{max-width:820px;margin:0 auto;display:grid;gap:14px;}
  .faq-item{background:#fff;border-radius:var(--radius-sm);box-shadow:var(--shadow);overflow:hidden;}
  .faq-q{width:100%;display:flex;align-items:center;justify-content:space-between;gap:16px;padding:22px 26px;text-align:left;font-weight:700;font-size:15.5px;color:var(--ink);}
  .faq-q .plus{width:28px;height:28px;border-radius:50%;background:var(--blue-tint);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:transform .25s ease, background .25s ease;}
  .faq-q .plus svg{width:14px;height:14px;color:var(--blue);}
  .faq-item.open .faq-q .plus{background:var(--gold);transform:rotate(135deg);}
  .faq-item.open .faq-q .plus svg{color:var(--blue-deep);}
  .faq-a{max-height:0;overflow:hidden;transition:max-height .3s ease;}
  .faq-a p{padding:0 26px 22px;font-size:14.5px;color:var(--ink-soft);max-width:640px;}

  /* ============ CTA ============ */
  .cta{padding:100px 0 110px;}
  .cta-card{background:linear-gradient(155deg,var(--blue-deep),var(--blue));border-radius:var(--radius-lg);padding:60px;text-align:center;color:#fff;position:relative;overflow:hidden;}
  .cta-card::before{content:'';position:absolute;width:320px;height:320px;border-radius:50%;background:rgba(255,183,3,.14);top:-140px;right:-80px;}
  .cta-card h2{color:#fff;font-size:clamp(24px,3.2vw,32px);margin-bottom:12px;position:relative;}
  .cta-card p{color:rgba(255,255,255,.8);max-width:460px;margin:0 auto 28px;position:relative;}
  .cta-actions{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;position:relative;}

  /* ============ RESPONSIVE ============ */
  @media (max-width:980px){
    .banner-inner{grid-template-columns:1fr;min-height:auto;}
    .banner-copy{padding:56px 24px 44px;order:2;}
    .banner-dots{display:none;}
    .banner-photo{clip-path:none;height:260px;order:1;}
    .banner-stat{bottom:16px;right:16px;padding:10px 16px;}

    .contact-card{grid-template-columns:1fr;padding:32px;}
    .form-row{grid-template-columns:1fr;}

    .map-hours-grid{grid-template-columns:1fr;}
    .map-box{min-height:280px;}
    .map-box iframe{min-height:280px;}

    .cta-card{padding:40px 26px;}
  }
  @media (max-width:560px){
    .banner-copy{padding:44px 20px 36px;}
    .contact-card{padding:24px;}
    .contact-form{padding:24px;}
    .hours-card{padding:28px 24px;}
  }
</style>
@endpush

@section('content')
<!-- ============ PAGE BANNER ============ -->
@if($banner)
<section class="banner">
  <div class="banner-inner">
    <div class="banner-copy reveal">
      <span class="banner-dots"></span>
      <div class="breadcrumb"><a href="{{ url('/') }}#home">Home</a><span>/</span><span class="current">Kontak</span></div>
      <h1>{{ $banner->title }}</h1>
      <p class="lead">{{ $banner->description }}</p>
    </div>
    <div class="banner-photo reveal">
      @if($banner->getFirstMediaUrl('contact_banner'))
        <img src="{{ $banner->getFirstMediaUrl('contact_banner') }}" alt="{{ $banner->title }}">
      @else
        <img src="https://images.pexels.com/photos/7092613/pexels-photo-7092613.jpeg" alt="Staf customer service">
      @endif
      
      @if($banner->stat_value || $banner->stat_label)
      <div class="banner-stat">
        <strong>{{ $banner->stat_value }}</strong>
        <span>{{ $banner->stat_label }}</span>
      </div>
      @endif
    </div>
  </div>
</section>
@endif

<!-- ============ CONTACT INFO + FORM ============ -->
<section class="contact" id="form-kontak">
  <div class="wrap">
    <div class="contact-card reveal">
      <div class="contact-info">
        <span class="eyebrow">Hubungi Kami</span>
        <h2>Informasi Kontak</h2>
        <p>Pilih cara yang paling nyaman buat kamu. Kami juga terbuka untuk kunjungan langsung ke kantor kalau mau lihat-lihat fasilitas dulu.</p>

        <div class="contact-row">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 1118 0z" stroke="#fff" stroke-width="1.8"/><circle cx="12" cy="10" r="3" stroke="#fff" stroke-width="1.8"/></svg></div>
          <div><strong>Alamat</strong><span>{{ $contactInfo->address ?? 'Menara Tendean Lantai 17 Unit C, Jalan Kapten Tendean No. 20C, Kelurahan: Kuningan Barat, Kecamatan: Mampang Prapatan, 12720' }}</span></div>
        </div>
        
        <div class="contact-row">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6A19.8 19.8 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.7a2 2 0 01-.5 2.1L8 9.7a16 16 0 006.3 6.3l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.5 2.7.6a2 2 0 011.7 2.1z" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div>
            <strong>Telepon / WhatsApp</strong>
            <span>{!! nl2br(e($contactInfo->phone ?? "085881486381 (Admin Nawal)\n085814010671 (Admin Ayza)")) !!}</span>
          </div>
        </div>
        
        <div class="contact-row">
          <div class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4V4z" stroke="#fff" stroke-width="1.8" stroke-linejoin="round"/><path d="M4 6l8 7 8-7" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <div><strong>Email</strong><span>{{ $contactInfo->email ?? 'halo@bimbelsmart.id' }}</span></div>
        </div>

        <!-- Bagian Sosial Media tetap hardcode -->
        <div class="socials">
            <a href="https://www.instagram.com/bimbelsmart__/" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.6"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor"/></svg></a>
            <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3a3 3 0 00-3 3v2H9v3h2v6h3v-6h2.5l.5-3H14V9z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg></a>
            <a href="https://www.tiktok.com/@bimbelprivatsmart" aria-label="TikTok"><svg viewBox="0 0 24 24" fill="none"><path d="M14 4c.3 2 1.8 3.5 4 3.8v3c-1.5 0-2.9-.4-4-1.2v6.1a4.9 4.9 0 11-4.2-4.9v3.1a1.9 1.9 0 101.4 1.8V4h2.8z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg></a>
        </div>
      </div>

      <div class="contact-form">
        <h3>Kirim Pesan ke Kami</h3>
        @if(session('success'))
        <div class="form-success show" style="display: flex;">
          <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8"/><path d="M8 12l3 3 5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          {{ session('success') }}
        </div>
        @endif
        <form id="kontakForm" method="POST" action="{{ route('kontak.submit') }}">
          @csrf
          <div class="form-row">
            <div class="field">
              <label for="name">Nama Lengkap</label>
              <!-- Ubah name dan old() menjadi 'name' -->
              <input type="text" id="name" name="name" placeholder="Nama kamu" value="{{ old('name') }}" required>
            </div>
            <div class="field">
              <label for="phone">No. Telepon</label>
              <!-- Ubah name dan old() menjadi 'phone' -->
              <input type="tel" id="phone" name="phone" placeholder="08xx-xxxx-xxxx" value="{{ old('phone') }}" required>
            </div>
          </div>
          <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}">
          </div>
          <div class="field">
            <label for="program_interest">Program yang Diminati</label>
            <select id="program_interest" name="program_interest">
              <option value="">Pilih program (opsional)</option>
              
              <!-- Looping data Program dari Halaman Beranda -->
              @foreach($programs as $program)
                <option value="{{ $program->name ?? $program->title }}">{{ $program->name ?? $program->title }}</option>
              @endforeach
              
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="field">
            <label for="message">Pesan</label>
            <!-- Ubah name dan old() menjadi 'message' -->
            <textarea id="message" name="message" placeholder="Ceritakan kebutuhan belajar kamu di sini..." required>{{ old('message') }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
          <p class="form-note">Dengan mengirim formulir ini, kamu setuju dihubungi oleh tim Bimbel Smart.</p>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ============ MAP + JAM OPERASIONAL ============ -->
<section class="map-hours">
  <div class="wrap">
    <div class="map-hours-grid reveal">
      <div class="map-box">
        <div class="map-pin"><svg viewBox="0 0 24 24" fill="none"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 1118 0z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.8"/></svg>Kantor Pusat Bimbel Smart</div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7932.364042806908!2d106.81493999357912!3d-6.239724899999977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3c080e2477d%3A0x10a81b643b21abac!2sMTen%20%2F%20Menara%20Tendean!5e0!3m2!1sen!2sus!4v1785998357159!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
      </div>
      <div class="hours-card">
        <h3><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3.5 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>Jam Operasional</h3>
          <div class="hours-list">
            <div class="hours-row"><span>Operasional Admin (Setiap Hari)</span><span>09.00 - 21.00</span></div>
            <div class="hours-row"><span>Operasional Kantor (Senin - Jumat)</span><span>08.00 - 17.30</span></div>
          </div>
      </div>
    </div>
  </div>
</section>
<!-- ============ FAQ ============ -->
<section class="faq">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Pertanyaan Umum</span>
      <h2>Sebelum Menghubungi Kami</h2>
      <p>Mungkin jawabannya sudah ada di sini.</p>
    </div>
    <div class="faq-list reveal">
      
      @forelse($faqs as $faq)
      <div class="faq-item">
        <button class="faq-q">
          <span>{{ $faq->question }}</span>
          <span class="plus">
            <svg viewBox="0 0 24 24" fill="none"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          </span>
        </button>
        <div class="faq-a"><p>{{ $faq->answer }}</p></div>
      </div>
      @empty
        <p style="text-align: center; color: var(--ink-soft);">Belum ada pertanyaan FAQ yang ditambahkan.</p>
      @endforelse

    </div>
  </div>
</section>
<!-- ============ CTA ============ -->
<section class="cta">
  <div class="wrap">
    <div class="cta-card reveal">
      <h2>Masih Ragu? Konsultasi Dulu, Gratis!</h2>
      <p>Ceritakan kebutuhan belajarmu, biar tim kami bantu rekomendasikan program yang paling cocok.</p>
      <div class="cta-actions">
        <a href="#form-kontak" class="btn btn-primary">Isi Formulir</a>
        <a href="{{ url('layanan') }}" class="btn btn-outline-light">Lihat Program</a>
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
      document.querySelectorAll('.faq-item').forEach(other => {
        other.classList.remove('open');
        other.querySelector('.faq-a').style.maxHeight = null;
      });
      if (!isOpen) {
        item.classList.add('open');
        a.style.maxHeight = a.scrollHeight + 'px';
      }
    });
  });
</script>
@endpush