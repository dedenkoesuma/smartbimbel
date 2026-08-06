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
    display:flex;flex-direction:column; /* Ditambahkan agar tinggi menyesuaikan & rapi */
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
    flex-grow:1; /* Memastikan teks mendorong tombol ke bawah jika panjang deskripsi berbeda */
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
    .program-grid{grid-template-columns:repeat(2,1fr);} /* Menjadi 2 kolom di tablet */
    .logo-grid{grid-template-columns:repeat(2,1fr);}
    .blog-grid{grid-template-columns:1fr;}
    .gallery-grid{grid-template-columns:repeat(2,1fr);}
    .contact-card{grid-template-columns:1fr;padding:32px;}
    .footer-grid{grid-template-columns:1fr;gap:36px;}
    .form-row{grid-template-columns:1fr;}
  }
  @media (max-width:768px){
    .program-grid{grid-template-columns:1fr;} /* Menjadi 1 kolom di mobile */
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
<section class="hero" id="home">
  <div class="wrap">
    <div class="hero-copy reveal">
      <span class="eyebrow">Bimbel Pilihan No. 1</span>
      <h1>Belajar Lebih
        <span class="hl gold">Seru
          <svg viewBox="0 0 120 20" preserveAspectRatio="none"><path d="M2 14C20 6 45 4 60 8C80 13 100 6 118 10L118 18C90 20 60 20 30 18C18 17 8 16 2 18Z"/></svg>
        </span>
        &amp; Masa Depan Lebih
        <span class="hl gold">Cemerlang
          <svg viewBox="0 0 220 20" preserveAspectRatio="none"><path d="M2 14C40 6 90 4 120 8C160 13 200 6 218 10L218 18C170 20 110 20 60 18C34 17 14 16 2 18Z"/></svg>
        </span>
      </h1>
      <p class="lead">Temukan metode belajar yang interaktif dan tutor berpengalaman yang siap membimbing anak Anda meraih prestasi impian, tanpa tekanan dan tanpa drama.</p>
      <div class="hero-actions">
        <a href="#kontak" class="btn btn-primary">Mulai Belajar</a>
        <a href="#program" class="btn btn-outline">Lihat Program</a>
      </div>
      <div class="hero-stats">
        <div><strong>15+</strong><span>Tahun Pengalaman</span></div>
        <div><strong>500+</strong><span>Siswa Aktif</span></div>
        <div><strong>50+</strong><span>Tutor Berpengalaman</span></div>
      </div>
    </div>
    <div class="hero-visual reveal">
      <div class="hero-blob"></div>
      <img class="hero-photo" src="https://images.pexels.com/photos/18931270/pexels-photo-18931270.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Siswa dan pengajar dalam sesi belajar (foto stok)">
    </div>
  </div>
</section>

<!-- ============ KENAPA PILIH BIMBEL SMART ============ -->
<section class="why" id="kenapa">
  <div class="wrap">
    <div class="why-visual reveal">
      <div class="why-img a">
        <img src="https://images.pexels.com/photos/18395403/pexels-photo-18395403.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Guru mendampingi siswa belajar (foto stok)">
      </div>
      <div class="why-img b">
        <img src="https://images.pexels.com/photos/6325982/pexels-photo-6325982.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Tutor mengajar satu siswa secara online (foto stok)">
      </div>
    </div>
    <div class="why-copy reveal">
      <span class="eyebrow">Kenapa Bimbel Smart</span>
      <h2>Kenapa Pilih <span class="hl gold blue-ink">Bimbel Smart<svg viewBox="0 0 260 20" preserveAspectRatio="none"><path d="M2 14C50 6 120 4 160 8C200 13 240 6 258 10L258 18C200 20 120 20 60 18C34 17 14 16 2 18Z"/></svg></span>?</h2>
      <p>Kami percaya setiap anak punya potensi untuk berkembang. Dengan pendekatan belajar yang personal, kami membantu si kecil menemukan cara belajar yang paling nyaman dan efektif untuknya.</p>
      <div class="why-list">
        <div class="why-item"><span class="why-check"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><p>Kurikulum terupdate &amp; relevan</p></div>
        <div class="why-item"><span class="why-check"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><p>Pengajar berpengalaman &amp; friendly</p></div>
        <div class="why-item"><span class="why-check"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><p>Tutor datang ke rumah</p></div>
        <div class="why-item"><span class="why-check"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><p>Laporan perkembangan berkala</p></div>
        <div class="why-item"><span class="why-check"><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><p>Jam belajar fleksibel</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROGRAM UNGGULAN (UPDATED) ============ -->
<section class="program" id="program">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow" style="background:rgba(255,255,255,.12);color:#FFD877;">Program Kami</span>
      <h2>Program Unggulan Kami</h2>
      <p>Pilih jenjang pendidikan dan program bahasa yang sesuai dengan kebutuhan belajar Anda.</p>
    </div>
    
    <div class="program-grid reveal">
      
      <!-- 1. Preschool -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>Preschool</h3>
        <p>Pendidikan usia dini dengan pendekatan belajar sambil bermain untuk melatih kemampuan kognitif dan motorik anak secara menyenangkan.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 2. Program SD -->
      <div class="program-card">
        <div class="program-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19.5V6a2 2 0 012-2h9a2 2 0 012 2v13.5M4 19.5h13M4 19.5a1.5 1.5 0 001.5 1.5H17M15 5v14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3>Program SD</h3>
        <p>Fokus pada pembentukan konsep dasar dan pengembangan minat belajar sejak dini agar anak menyukai proses belajar.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 3. Program SMP -->
      <div class="program-card">
        <div class="program-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 013 3L7 19l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3>Program SMP</h3>
        <p>Pendampingan intensif untuk menguasai materi sekolah, bantu anak berprestasi, dan siap menuju SMA impian favorit.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 4. Program SMA -->
      <div class="program-card">
        <div class="program-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M22 10L12 5 2 10l10 5 10-5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M6 12v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3>Program SMA</h3>
        <p>Persiapan matang menghadapi ujian sekolah dan strategi ampuh tembus UTBK agar masuk Perguruan Tinggi Negeri incaran.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 5. Kelas Online Reguler -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>Kelas Online Reguler</h3>
        <p>Bimbingan belajar mata pelajaran sekolah secara daring dengan jadwal fleksibel, diakses dari rumah dengan tutor interaktif.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 6. Kelas Online Bahasa -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><ellipse cx="12" cy="12" rx="4" ry="10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="2" y1="12" x2="22" y2="12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>Kelas Online Bahasa</h3>
        <p>Belajar bahasa asing dari mana saja. Menghadirkan suasana interaktif dan kolaboratif layaknya kelas offline, namun secara daring.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 7. Bahasa Inggris -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>Bahasa Inggris</h3>
        <p>Program pengembangan Speaking, Listening, Reading, Writing & Grammar untuk membangun kompetensi unggul di akademik maupun karier global.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 8. Bahasa Mandarin -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><path d="M5 8l6 6M4 14l6-6 2-3M2 5h12M7 2h1M22 22l-5-10-5 10M14 18h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>Bahasa Mandarin</h3>
        <p>Pembelajaran komprehensif untuk membangun kemampuan dan kepercayaan diri berkomunikasi dalam bahasa Mandarin di dunia pendidikan dan bisnis.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

      <!-- 9. TOEFL & IELTS -->
      <div class="program-card">
        <div class="program-icon">
          <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h3>TOEFL & IELTS Prep</h3>
        <p>Persiapan intensif sertifikasi internasional dengan strategi pengerjaan soal dan simulasi (Mock Test) untuk target studi ke luar negeri atau beasiswa.</p>
        <a href="#kontak" class="btn btn-outline" style="padding:11px 22px;font-size:14px; margin-top: auto; align-self: flex-start;">Lihat Program</a>
      </div>

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
<section class="gallery" id="galeri">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Galeri Kegiatan</span>
      <h2>Lihat Lebih Dekat Keseruan Belajar di Bimbel Smart</h2>
      <p>Momen-momen seru belajar dan keberhasilan siswa-siswi kami.</p>
    </div>
    <div class="gallery-grid reveal">
      <div class="gallery-item g1">
        <img src="https://images.unsplash.com/photo-1568667256549-094345857637?auto=format&fit=crop&w=800&q=80" alt="Fasilitas perpustakaan dan ruang baca">
        <div class="tint"></div>
        <span class="caption">Fasilitas Belajar</span>
      </div>
      
      <div class="gallery-item g2">
        <!-- Try Out Bersama: Tangan sedang menulis di atas kertas ujian -->
        <img src="https://images.pexels.com/photos/3729557/pexels-photo-3729557.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Mengerjakan soal try out">
        <div class="tint"></div>
        <span class="caption">Try Out Bersama</span>
      </div>
      
      <div class="gallery-item g3">
        <!-- Kunjungan Kampus: Tampak luar gedung dengan arsitektur klasik -->
        <img src="https://images.pexels.com/photos/356065/pexels-photo-356065.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Tampak luar gedung kampus universitas">
        <div class="tint"></div>
        <span class="caption">Kunjungan Kampus</span>
      </div>
      
      <div class="gallery-item g4">
        <!-- Wisuda Angkatan: Topi toga dan ijazah di atas meja -->
        <img src="https://images.pexels.com/photos/1205651/pexels-photo-1205651.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Topi toga dan ijazah">
        <div class="tint"></div>
        <span class="caption">Wisuda Angkatan</span>
      </div>
    </div>
  </div>
</section>

<!-- ============ HUBUNGI KAMI ============ -->
<section class="contact" id="kontak">
  <div class="wrap">
    <div class="contact-card reveal">
      <div class="contact-info">
        <span class="eyebrow">Hubungi Kami</span>
        <h2>Punya Pertanyaan? Jangan Ragu Bertanya</h2>
        <p>Tim kami siap membantu menjawab pertanyaan seputar program belajar kapan saja.</p>
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4V4z" stroke="currentColor" stroke-width="1.6"/><path d="M4 6l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>Email Kami</strong><span>halo@bimbelsmart.id</span></div>
        </div>
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.1-7-11a7 7 0 1114 0c0 4.9-7 11-7 11z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="10" r="2.4" stroke="currentColor" stroke-width="1.6"/></svg></span>
          <div><strong>Kunjungi Kantor</strong><span>Menara Tendean Lantai 17 Unit C, Jalan Kapten Tendean No. 20C, Kelurahan: Kuningan Barat, Kecamatan: Mampang Prapatan, 12720</span></div>
        </div>
        <div class="contact-row">
          <span class="ic"><svg viewBox="0 0 24 24" fill="none"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3.1-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.7a2 2 0 01-.5 2.1L8 9.7a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.5 2.7.6a2 2 0 011.7 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <div><strong>WhatsApp Admin</strong><span>+62 858 8148 6381</span></div>
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