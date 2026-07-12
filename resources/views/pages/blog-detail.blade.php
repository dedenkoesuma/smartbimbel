@extends('layouts.app')

@php
  /*
    Data artikel masih statis (belum ada tabel/model Post di database).
    Kalau nanti sudah ada Post model, blok @php ini tinggal dihapus dan
    ganti pemanggilan di route/controller pakai Post::where('slug', $slug)->firstOrFail().
  */
  $posts = [
    [
      'slug' => '5-kebiasaan-kecil-bikin-anak-semangat-belajar',
      'category' => 'tips',
      'title' => '5 Kebiasaan Kecil yang Bikin Anak Makin Semangat Belajar',
      'date' => '28 Jun 2026',
      'read_time' => '5 min baca',
      'image' => 'https://images.pexels.com/photos/9572630/pexels-photo-9572630.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Dua siswa belajar bersama di perpustakaan (foto stok)',
      'excerpt' => 'Kadang yang dibutuhkan bukan jadwal belajar yang lebih ketat, tapi kebiasaan kecil yang tepat.',
      'content' => [
        'Banyak orang tua mengira anak yang malas belajar butuh jadwal yang lebih ketat dan aturan yang lebih tegas. Padahal, dalam banyak kasus, yang sebenarnya dibutuhkan adalah kebiasaan-kebiasaan kecil yang konsisten dilakukan setiap hari — bukan tekanan yang lebih besar.',
        '<strong>1. Mulai dari sesi belajar singkat.</strong> Alih-alih memaksa anak duduk selama dua jam penuh, coba mulai dengan sesi 20-25 menit yang fokus, lalu istirahat sebentar. Otak anak lebih mudah menyerap informasi lewat sesi pendek yang berulang daripada satu sesi panjang yang melelahkan.',
        '<strong>2. Sediakan "meja belajar tetap".</strong> Tempat yang konsisten membantu otak anak mengasosiasikan lokasi tersebut dengan mode fokus. Tidak perlu mewah, cukup meja yang bebas dari gangguan visual seperti mainan atau gadget.',
        '<strong>3. Rayakan proses, bukan cuma nilai.</strong> Memberi apresiasi ketika anak berusaha — bahkan saat hasilnya belum sempurna — membuat anak lebih berani mencoba dan tidak takut gagal.',
        '<strong>4. Libatkan anak dalam menyusun jadwalnya sendiri.</strong> Anak yang ikut menentukan kapan waktu belajarnya cenderung lebih patuh dibanding jadwal yang sepenuhnya ditentukan orang tua.',
        '<strong>5. Jadikan waktu tidur sebagai prioritas.</strong> Tidur cukup terbukti berkontribusi besar pada daya ingat dan konsentrasi anak di sekolah keesokan harinya — sering kali lebih berpengaruh daripada jam belajar tambahan.',
        'Kebiasaan kecil yang dilakukan konsisten setiap hari, dalam jangka panjang, biasanya memberi hasil yang jauh lebih stabil dibanding dorongan besar yang hanya bertahan beberapa minggu.',
      ],
    ],
    [
      'slug' => 'cara-menyusun-jadwal-belajar-realistis-anak-sd',
      'category' => 'tips',
      'title' => 'Cara Menyusun Jadwal Belajar yang Realistis untuk Anak SD',
      'date' => '25 Jun 2026',
      'read_time' => '4 min baca',
      'image' => 'https://images.pexels.com/photos/6214651/pexels-photo-6214651.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Anak membaca buku di ruang belajar (foto stok)',
      'excerpt' => 'Jadwal belajar yang terlalu padat justru bikin anak cepat lelah. Ini cara menyusunnya biar tetap efektif.',
      'content' => [
        'Anak usia SD punya rentang fokus yang jauh lebih pendek dibanding orang dewasa. Jadwal belajar yang disusun berdasarkan logika orang dewasa — misalnya belajar dua jam nonstop — biasanya berakhir dengan anak yang rewel dan materi yang tidak masuk sama sekali.',
        'Aturan praktis yang cukup membantu adalah durasi fokus sekitar 2-3 menit dikali usia anak. Jadi anak usia 8 tahun idealnya belajar fokus sekitar 16-24 menit sebelum butuh jeda.',
        'Selain durasi, urutan mata pelajaran juga berpengaruh. Menaruh pelajaran yang paling menantang di awal sesi — saat energi dan fokus anak masih penuh — biasanya lebih efektif daripada menyimpannya di akhir.',
        'Terakhir, sisakan slot "buffer" di jadwal untuk hari-hari yang tidak berjalan sesuai rencana. Jadwal yang terlalu kaku justru rentan bikin anak (dan orang tua) merasa gagal saat satu hari saja terlewat.',
      ],
    ],
    [
      'slug' => 'yang-berubah-dari-utbk-2026',
      'category' => 'info',
      'title' => 'Yang Berubah dari UTBK 2026, Orang Tua Wajib Tahu',
      'date' => '22 Jun 2026',
      'read_time' => '6 min baca',
      'image' => 'https://images.pexels.com/photos/6684209/pexels-photo-6684209.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Siswa mengerjakan ujian (foto stok)',
      'excerpt' => 'Ada beberapa penyesuaian format dan jadwal UTBK tahun ini yang penting diketahui sejak awal.',
      'content' => [
        'Setiap tahun, format UTBK biasanya mengalami penyesuaian kecil — baik dari sisi materi, durasi, maupun jadwal pelaksanaan. Penting bagi orang tua dan siswa untuk mengikuti pengumuman resmi agar strategi belajar bisa disesuaikan sejak jauh hari.',
        'Beberapa hal yang biasanya paling sering berubah antara lain: komposisi soal Tes Potensi Skolastik (TPS), alokasi waktu per subtes, dan jumlah gelombang ujian yang tersedia.',
        'Yang tidak kalah penting adalah persiapan mental. Perubahan format sering bikin siswa cemas berlebihan, padahal fondasi belajar yang solid — pemahaman konsep, bukan sekadar hafalan soal — tetap jadi kunci utama apa pun format ujiannya.',
        'Untuk info resmi dan jadwal terbaru, selalu rujuk ke situs resmi penyelenggara SNPMB, dan diskusikan dengan tutor atau pembimbing untuk menyesuaikan strategi belajar anak.',
      ],
    ],
    [
      'slug' => 'dari-nilai-pas-pasan-ke-juara-kelas-kirana',
      'category' => 'sukses',
      'title' => 'Dari Nilai Pas-Pasan ke Juara Kelas: Cerita Kirana',
      'date' => '19 Jun 2026',
      'read_time' => '5 min baca',
      'image' => 'https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Wisuda mahasiswa (foto stok)',
      'excerpt' => 'Perjalanan seorang siswa yang awalnya minder soal Matematika, sampai akhirnya jadi juara kelas.',
      'content' => [
        'Kirana masih ingat betul rasanya duduk di kelas Matematika sambil berharap tidak ditunjuk maju ke depan. Nilai ulangannya sering di bawah rata-rata, dan ia mulai percaya bahwa dirinya memang "tidak berbakat" di pelajaran itu.',
        'Titik baliknya datang bukan dari les tambahan yang lebih banyak, tapi dari cara belajar yang berbeda: alih-alih menghafal rumus, ia mulai diajak memahami logika di balik setiap rumus lewat contoh sehari-hari.',
        '<em>"Awalnya aku kira aku emang nggak bisa Matematika. Ternyata aku cuma belum ketemu cara belajar yang cocok buat aku,"</em> ujar Kirana mengenang perjalanannya.',
        'Dalam waktu dua semester, nilai Matematikanya naik signifikan, dan ia berhasil meraih peringkat pertama di kelasnya. Bukan karena mendadak jadi jenius, tapi karena akhirnya menemukan pendekatan belajar yang sesuai dengan gaya berpikirnya.',
        'Cerita Kirana jadi pengingat bahwa kesulitan belajar sering kali bukan soal kemampuan, tapi soal metode yang belum pas.',
      ],
    ],
    [
      'slug' => '5-aplikasi-seru-latihan-speaking-bahasa-inggris',
      'category' => 'english',
      'title' => '5 Aplikasi Seru untuk Latihan Speaking Bahasa Inggris',
      'date' => '16 Jun 2026',
      'read_time' => '3 min baca',
      'image' => 'https://images.pexels.com/photos/6325982/pexels-photo-6325982.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Tutor membimbing siswa belajar (foto stok)',
      'excerpt' => 'Belajar speaking nggak melulu lewat buku. Coba lima aplikasi ini biar anak makin pede ngomong Inggris.',
      'content' => [
        'Kepercayaan diri berbicara bahasa Inggris sering kali lebih sulit dibangun dibanding penguasaan grammar. Untungnya, ada banyak aplikasi yang dirancang khusus untuk melatih speaking dengan cara yang menyenangkan dan tidak menghakimi.',
        'Aplikasi berbasis percakapan interaktif membantu anak berlatih pengucapan tanpa rasa takut salah di depan orang lain, karena mereka berlatih dengan AI atau rekaman suara sendiri terlebih dahulu.',
        'Fitur pengenalan suara pada aplikasi-aplikasi ini juga memberi umpan balik langsung soal pelafalan, sehingga anak bisa memperbaiki kesalahan kecil sebelum kebiasaan itu melekat.',
        'Yang paling penting: jadikan sesi latihan ini sebagai rutinitas ringan 10-15 menit sehari, bukan target besar yang membebani. Konsistensi kecil jauh lebih efektif dibanding sesi panjang yang jarang dilakukan.',
      ],
    ],
    [
      'slug' => 'menumbuhkan-minat-baca-pada-anak-sejak-dini',
      'category' => 'tips',
      'title' => 'Menumbuhkan Minat Baca pada Anak Sejak Dini',
      'date' => '13 Jun 2026',
      'read_time' => '4 min baca',
      'image' => 'https://images.pexels.com/photos/10638213/pexels-photo-10638213.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Anak-anak membaca buku bersama (foto stok)',
      'excerpt' => 'Minat baca nggak muncul begitu saja — ini beberapa kebiasaan kecil yang bisa orang tua mulai dari rumah.',
      'content' => [
        'Minat baca jarang tumbuh dari paksaan. Anak yang terus-menerus disuruh membaca tanpa contoh nyata di sekitarnya cenderung menganggap membaca sebagai kewajiban, bukan kesenangan.',
        'Salah satu cara paling efektif adalah dengan menunjukkan, bukan menyuruh — orang tua yang terlihat menikmati membaca buku secara alami menanamkan citra bahwa membaca itu menyenangkan.',
        'Memberi anak kebebasan memilih buku sesuai minatnya sendiri, meskipun terlihat "ringan" di mata orang dewasa, jauh lebih efektif dibanding memaksakan buku yang dianggap lebih "bermutu".',
        'Rutinitas kecil seperti membacakan cerita sebelum tidur, atau kunjungan rutin ke perpustakaan, juga terbukti membangun asosiasi positif antara membaca dan momen-momen yang menyenangkan.',
      ],
    ],
    [
      'slug' => 'cara-mendampingi-anak-belajar-tanpa-baper',
      'category' => 'parenting',
      'title' => 'Cara Mendampingi Anak Belajar Tanpa Baper',
      'date' => '10 Jun 2026',
      'read_time' => '5 min baca',
      'image' => 'https://images.pexels.com/photos/8926887/pexels-photo-8926887.jpeg?auto=compress&cs=tinysrgb&w=1200',
      'image_alt' => 'Anak-anak belajar di perpustakaan (foto stok)',
      'excerpt' => 'Sering emosi tiap dampingi anak belajar di rumah? Coba beberapa pendekatan ini biar sesi belajar tetap adem.',
      'content' => [
        'Momen mendampingi anak belajar di rumah sering berubah jadi ajang adu emosi — bukan karena orang tua tidak sabar, tapi karena ekspektasi yang tidak realistis terhadap kecepatan belajar anak.',
        'Salah satu penyebab utama frustrasi adalah membandingkan progres anak dengan standar orang dewasa, padahal proses berpikir anak memang butuh waktu lebih lama untuk hal-hal yang bagi kita terasa sederhana.',
        'Mengambil jeda sejenak ketika emosi mulai naik — baik dari orang tua maupun anak — jauh lebih efektif daripada memaksakan sesi belajar terus berjalan di tengah suasana yang tegang.',
        'Terakhir, penting untuk mengingat bahwa peran orang tua di rumah adalah pendamping, bukan guru utama. Berkolaborasi dengan tutor atau bimbingan belajar bisa membantu meringankan beban ini sekaligus menjaga hubungan orang tua dan anak tetap hangat.',
      ],
    ],
  ];

  $categoryLabels = [
    'tips' => 'Tips Belajar',
    'info' => 'Info Pendidikan',
    'sukses' => 'Cerita Sukses',
    'english' => 'English Corner',
    'parenting' => 'Parenting',
  ];

  $post = collect($posts)->firstWhere('slug', $slug ?? null);

  if (! $post) {
      abort(404);
  }

  $related = collect($posts)
      ->where('slug', '!=', $post['slug'])
      ->where('category', $post['category'])
      ->values();

  if ($related->count() < 3) {
      $filler = collect($posts)
          ->where('slug', '!=', $post['slug'])
          ->whereNotIn('slug', $related->pluck('slug'));
      $related = $related->merge($filler->take(3 - $related->count()));
  }

  $related = $related->take(3);
@endphp

@section('title', $post['title'].' — Bimbel Smart')
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
      <span class="current">{{ $categoryLabels[$post['category']] ?? 'Artikel' }}</span>
    </div>
    <span class="post-tag reveal">{{ $categoryLabels[$post['category']] ?? 'Artikel' }}</span>
    <h1 class="reveal">{{ $post['title'] }}</h1>
    <div class="post-meta reveal">
      <span>{{ $post['date'] }}</span><span class="dot"></span><span>{{ $post['read_time'] }}</span>
    </div>
  </div>
</section>

<!-- ============ POST BODY ============ -->
<section class="post-body">
  <div class="wrap post-layout">
    <article class="reveal">
      <div class="post-cover">
        <img src="{{ $post['image'] }}" alt="{{ $post['image_alt'] }}">
      </div>
      <div class="post-text">
        @foreach ($post['content'] as $paragraph)
          <p>{!! $paragraph !!}</p>
        @endforeach
      </div>

      <div class="post-share">
        <span>Bagikan artikel:</span>
        <div class="share-links">
          <a href="https://wa.me/?text={{ urlencode($post['title'].' - '.request()->fullUrl()) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
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
              @if($key === $post['category'])
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
            <a href="{{ route('blog.show', $item['slug']) }}" class="related-item">
              <div class="thumb"><img src="{{ $item['image'] }}" alt="{{ $item['image_alt'] }}"></div>
              <div>
                <h5>{{ $item['title'] }}</h5>
                <span>{{ $item['date'] }}</span>
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