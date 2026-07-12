@extends('layouts.app')

@section('title', 'Tentang Kami — Bimbel Smart')
@section('page', 'tentang')

@push('styles')
<style>
/* Token, reset, tombol, navbar & mobile-nav dasar sudah ada di assets/style.css */


  /* ============ PAGE BANNER (beda dari hero home — panel diagonal) ============ */
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
  .banner-copy p.lead{color:rgba(255,255,255,.78);max-width:420px;font-size:16px;}

  .banner-photo{
    position:relative;
    clip-path:polygon(14% 0, 100% 0, 100% 100%, 0% 100%);
  }
  .banner-photo img{width:100%;height:100%;object-fit:cover;}
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
  .values-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;}
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

  /* Style footer & reveal dasar sudah ada di assets/style.css */


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
  }
</style>
@endpush

@section('content')
<!-- ============ PAGE BANNER ============ -->
<section class="banner">
  <div class="banner-inner">
    <div class="banner-copy reveal">
      <div class="banner-dots"></div>
      <div class="breadcrumb"><a href="{{ route('home') }}#home">Home</a><span>/</span><span class="current">Tentang Kami</span></div>
      <h1>Mengenal Lebih Dekat Bimbel Smart</h1>
      <p class="lead">Cerita, nilai, dan orang-orang di balik komitmen kami membimbing generasi muda meraih prestasi terbaiknya.</p>
    </div>
    <div class="banner-photo reveal">
      <img src="https://images.pexels.com/photos/18395403/pexels-photo-18395403.jpeg?auto=compress&cs=tinysrgb&w=1000" alt="Suasana belajar di Bimbel Smart (foto stok)">
      <div class="banner-stat">
        <strong>15+</strong>
        <span>Tahun Pengalaman</span>
      </div>
    </div>
  </div>
</section>

<!-- ============ CERITA KAMI ============ -->
<section class="story">
  <div class="wrap">
    <div class="story-visual reveal">
      <div class="story-img a">
        <img src="https://images.pexels.com/photos/6325982/pexels-photo-6325982.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Tutor membimbing siswa secara personal (foto stok)">
      </div>
      <div class="story-badge">
        <strong>15+</strong>
        <span>Tahun Membimbing Siswa</span>
      </div>
    </div>
    <div class="story-copy reveal">
      <span class="eyebrow">Cerita Kami</span>
      <h2>Bermula dari Bimbingan Kecil, Tumbuh Jadi Kepercayaan Banyak Keluarga</h2>
      <p>Bimbel Smart lahir dari hal sederhana: keinginan untuk membantu anak-anak belajar tanpa rasa takut dan tekanan. Berawal dari beberapa kelas kecil di rumah, kami perlahan berkembang menjadi tempat belajar yang dipercaya ratusan keluarga di berbagai kota.</p>
      <p>Seiring waktu, kami terus menyempurnakan metode belajar, merekrut tutor-tutor terbaik lulusan universitas ternama, dan membangun kurikulum yang relevan dengan kebutuhan siswa masa kini — mulai dari jenjang SD hingga persiapan UTBK di tingkat SMA.</p>
      <p>Hari ini, Bimbel Smart hadir sebagai mitra belajar yang tidak hanya fokus pada nilai akademik, tapi juga pada tumbuhnya rasa percaya diri dan semangat belajar jangka panjang setiap anak.</p>
    </div>
  </div>
</section>

<!-- ============ VISI & MISI ============ -->
<section class="vm">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Visi &amp; Misi</span>
      <h2>Arah yang Kami Tuju</h2>
      <p>Setiap program dan keputusan kami selalu kembali pada dua hal ini.</p>
    </div>
    <div class="vm-grid reveal">
      <div class="vm-card visi">
        <div class="vm-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.7"/></svg></div>
        <h3>Visi Kami</h3>
        <p>Menjadi lembaga bimbingan belajar terpercaya yang membentuk generasi muda Indonesia yang cerdas, mandiri, dan siap menghadapi masa depan dengan percaya diri.</p>
      </div>
      <div class="vm-card misi">
        <div class="vm-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M9 11l3 3L22 4M12 21a9 9 0 100-18 9 9 0 000 18z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <h3>Misi Kami</h3>
        <ul>
          <li><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>Menyediakan kurikulum belajar yang relevan dan terus diperbarui.</li>
          <li><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>Menghadirkan tutor berpengalaman yang peduli pada tiap siswa.</li>
          <li><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>Membangun lingkungan belajar yang nyaman, suportif, dan fleksibel.</li>
          <li><svg viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>Mendampingi orang tua memantau perkembangan belajar anak secara transparan.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ NILAI-NILAI KAMI ============ -->
<section class="values">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Nilai-Nilai Kami</span>
      <h2>Prinsip yang Kami Pegang Teguh</h2>
      <p>Empat nilai ini menjadi fondasi dalam setiap interaksi kami dengan siswa dan orang tua.</p>
    </div>
    <div class="values-grid reveal">
      <div class="value-card">
        <div class="value-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.9 6.9L22 9.5l-5.3 4.8L18 22l-6-3.6L6 22l1.3-7.7L2 9.5l7.1-.6L12 2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></div>
        <h4>Kualitas</h4>
        <p>Standar pengajaran yang konsisten dan terus dievaluasi demi hasil belajar terbaik.</p>
      </div>
      <div class="value-card">
        <div class="value-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 000-7.8z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></div>
        <h4>Kepedulian</h4>
        <p>Setiap siswa punya cara belajar sendiri, dan kami hadir untuk memahaminya.</p>
      </div>
      <div class="value-card">
        <div class="value-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 2l8 4v6c0 5-3.4 8.9-8 10-4.6-1.1-8-5-8-10V6l8-4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></div>
        <h4>Integritas</h4>
        <p>Jujur dan transparan kepada orang tua soal proses maupun hasil belajar anak.</p>
      </div>
      <div class="value-card">
        <div class="value-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M9 18h6M10 22h4M12 2a6 6 0 00-4 10.5c.6.6 1 1.4 1 2.3V16h6v-1.2c0-.9.4-1.7 1-2.3A6 6 0 0012 2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></div>
        <h4>Inovasi</h4>
        <p>Terbuka pada metode dan teknologi baru yang membuat belajar makin efektif.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ STATS ============ -->
<section class="stats">
  <div class="wrap">
    <div class="stats-grid reveal">
      <div class="stat-item">
        <div class="stat-num"><span class="counter" data-target="15">0</span><span>+</span></div>
        <div class="stat-label">Tahun Pengalaman</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span class="counter" data-target="500">0</span><span>+</span></div>
        <div class="stat-label">Siswa Aktif</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span class="counter" data-target="50">0</span><span>+</span></div>
        <div class="stat-label">Tutor Berpengalaman</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span class="counter" data-target="12">0</span><span>+</span></div>
        <div class="stat-label">Kota Terjangkau</div>
      </div>
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
    <!-- Data tim masih dummy — ganti nama, jabatan, dan foto dengan data tim asli -->
    <div class="team-grid reveal">
      <div class="team-card">
        <div class="team-photo"><img src="https://ui-avatars.com/api/?name=Nadia+Putri&background=FFD877&color=141B4D&bold=true&size=128" alt="Foto placeholder Nadia Putri"></div>
        <div class="team-info"><h4>Nadia Putri</h4><span>Founder &amp; Direktur</span></div>
      </div>
      <div class="team-card">
        <div class="team-photo"><img src="https://ui-avatars.com/api/?name=Bima+Satria&background=FFD877&color=141B4D&bold=true&size=128" alt="Foto placeholder Bima Satria"></div>
        <div class="team-info"><h4>Bima Satria</h4><span>Kepala Akademik</span></div>
      </div>
      <div class="team-card">
        <div class="team-photo"><img src="https://ui-avatars.com/api/?name=Rina+Wulandari&background=FFD877&color=141B4D&bold=true&size=128" alt="Foto placeholder Rina Wulandari"></div>
        <div class="team-info"><h4>Rina Wulandari</h4><span>Koordinator Tutor</span></div>
      </div>
      <div class="team-card">
        <div class="team-photo"><img src="https://ui-avatars.com/api/?name=Dimas+Aditya&background=FFD877&color=141B4D&bold=true&size=128" alt="Foto placeholder Dimas Aditya"></div>
        <div class="team-info"><h4>Dimas Aditya</h4><span>Kepala Operasional</span></div>
      </div>
    </div>
    <p class="team-note reveal">*Nama, jabatan, dan foto di atas masih data dummy — siap diganti dengan data tim asli.</p>
  </div>
</section>

<!-- ============ TESTIMONI ============ -->
<section class="testi">
  <div class="wrap">
    <div class="section-head center reveal">
      <span class="eyebrow">Kata Mereka</span>
      <h2>Apa Kata Orang Tua &amp; Siswa Kami</h2>
      <p>Cerita nyata dari keluarga yang sudah belajar bersama Bimbel Smart. (Data dummy — siap diganti dengan testimoni asli)</p>
    </div>
    <div class="testi-grid reveal">
      <div class="testi-card">
        <svg class="testi-quote-icon" viewBox="0 0 24 24" fill="none"><path d="M7 7a4 4 0 00-4 4v6h6v-6H6a2 2 0 012-2V7zM17 7a4 4 0 00-4 4v6h6v-6h-3a2 2 0 012-2V7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
        <p class="msg">"Sejak ikut Bimbel Smart, anak saya jadi lebih semangat belajar matematika. Tutornya sabar dan komunikatif ke orang tua."</p>
        <div class="testi-person">
          <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=2C3E9E&color=fff&bold=true&size=92" alt="Foto placeholder Ibu Siti Aminah">
          <div><strong>Ibu Siti Aminah</strong><span>Orang Tua Siswa SD</span></div>
        </div>
      </div>
      <div class="testi-card">
        <svg class="testi-quote-icon" viewBox="0 0 24 24" fill="none"><path d="M7 7a4 4 0 00-4 4v6h6v-6H6a2 2 0 012-2V7zM17 7a4 4 0 00-4 4v6h6v-6h-3a2 2 0 012-2V7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
        <p class="msg">"Jadwal les yang fleksibel sangat membantu karena anak saya juga aktif ekskul. Laporan perkembangannya jelas tiap bulan."</p>
        <div class="testi-person">
          <img src="https://ui-avatars.com/api/?name=Andre+Wijaya&background=2C3E9E&color=fff&bold=true&size=92" alt="Foto placeholder Bapak Andre Wijaya">
          <div><strong>Bapak Andre Wijaya</strong><span>Orang Tua Siswa SMP</span></div>
        </div>
      </div>
      <div class="testi-card">
        <svg class="testi-quote-icon" viewBox="0 0 24 24" fill="none"><path d="M7 7a4 4 0 00-4 4v6h6v-6H6a2 2 0 012-2V7zM17 7a4 4 0 00-4 4v6h6v-6h-3a2 2 0 012-2V7z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>
        <p class="msg">"Persiapan UTBK di sini beda, latihan soalnya banyak dan pembahasannya gampang dimengerti. Terima kasih Bimbel Smart!"</p>
        <div class="testi-person">
          <img src="https://ui-avatars.com/api/?name=Kirana+Ayu&background=2C3E9E&color=fff&bold=true&size=92" alt="Foto placeholder Kirana Ayu">
          <div><strong>Kirana Ayu</strong><span>Siswa SMA</span></div>
        </div>
      </div>
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
        <a href="{{ route('home') }}#kontak" class="btn btn-primary">Hubungi Kami</a>
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
</script>
@endpush
