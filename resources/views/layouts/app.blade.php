<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Bimbel Smart')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">
@stack('styles')
</head>
<body data-page="@yield('page')">

@include('partials.header')

@yield('content')

@include('partials.footer')

<script src="{{ asset('assets/main.js') }}"></script>
@stack('scripts')

<!-- ============ GLOBAL TOAST NOTIFICATION ============ -->
@if(session('newsletter_success') || session('success') || $errors->any())
<div id="globalToast" class="toast-notif {{ $errors->any() ? 'is-error' : 'is-success' }}">
    <div class="toast-icon">
        @if($errors->any())
            <!-- Icon Silang (Error) -->
            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M12 8v4m0 4h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @else
            <!-- Icon Centang (Success) -->
            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/><path d="M8 12l3 3 5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        @endif
    </div>
    <div class="toast-text">
        @if(session('newsletter_success'))
            {{ session('newsletter_success') }}
        @elseif(session('success'))
            {{ session('success') }}
        @elseif($errors->has('email'))
            {{ $errors->first('email') }}
        @else
            Mohon periksa kembali isian formulir kamu.
        @endif
    </div>
    <button class="toast-close" onclick="closeToast()">&times;</button>
</div>

<style>
    .toast-notif {
        position: fixed; top: 24px; right: 24px; z-index: 9999999;
        background: #fff; border-radius: 12px; padding: 16px 20px;
        display: flex; align-items: center; gap: 14px;
        box-shadow: 0 15px 30px -5px rgba(0,0,0,0.15), 0 8px 10px -6px rgba(0,0,0,0.1);
        transform: translateX(150%);
        animation: slideInToast 0.5s cubic-bezier(0.18, 0.89, 0.32, 1.28) forwards;
        border-left: 5px solid;
    }
    .toast-notif.is-success { border-left-color: #10b981; }
    .toast-notif.is-error { border-left-color: #ef4444; }
    
    .toast-icon svg { width: 24px; height: 24px; }
    .is-success .toast-icon svg { color: #10b981; }
    .is-error .toast-icon svg { color: #ef4444; }
    
    .toast-text { font-size: 14.5px; font-weight: 600; color: #1e293b; max-width: 320px; line-height: 1.4; }
    .toast-close {
        background: none; border: none; font-size: 26px; color: #94a3b8;
        cursor: pointer; padding: 0; margin-left: 10px; line-height: 1; transition: color 0.2s;
    }
    .toast-close:hover { color: #475569; }
    
    @keyframes slideInToast { to { transform: translateX(0); } }
    @keyframes slideOutToast { to { transform: translateX(150%); opacity: 0; } }
    
    @media (max-width: 560px) {
        .toast-notif { top: 16px; right: 16px; left: 16px; }
    }
</style>

<script>
    function closeToast() {
        const toast = document.getElementById('globalToast');
        if (toast) {
            toast.style.animation = 'slideOutToast 0.4s ease forwards';
            setTimeout(() => toast.remove(), 400);
        }
    }
    
    // Otomatis hilang setelah 5 detik
    setTimeout(closeToast, 5000);
</script>
@endif


<!-- ============ GLOBAL POP-UP PROMO ============ -->
@php
    // Logika untuk mengambil banner yang aktif dan sesuai jadwal tayang
    $popup = \App\Models\PopupBanner::where('is_active', true)
        ->where(function ($query) {
            $query->whereNull('start_date')->orWhere('start_date', '<=', now()->toDateString());
        })
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now()->toDateString());
        })
        ->latest()
        ->first();
@endphp

@if($popup && $popup->getFirstMediaUrl('popup_image'))
    <div id="promoPopup" class="popup-overlay">
        <div class="popup-content">
            <button id="closePopup" class="close-popup-btn">&times;</button>
            
            <!-- Link otomatis mengarah ke form kontak -->
            <a href="{{ url('kontak') }}#form-kontak">
                <img src="{{ $popup->getFirstMediaUrl('popup_image') }}" alt="{{ $popup->title }}">
            </a>
            
        </div>
    </div>

    <style>
        .popup-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.75); z-index: 99999;
            display: none; justify-content: center; align-items: center;
            padding: 24px; backdrop-filter: blur(4px);
        }
        .popup-overlay.show {
            display: flex;
        }
        .popup-content {
            position: relative; max-width: 500px; width: 100%;
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            animation: popIn 0.5s cubic-bezier(0.18, 0.89, 0.32, 1.28) forwards;
            opacity: 0; transform: scale(0.8);
        }
        .popup-content img {
            width: 100%; height: auto; display: block;
        }
        .close-popup-btn {
            position: absolute; top: 12px; right: 12px;
            background: #fff; border: none; width: 34px; height: 34px;
            border-radius: 50%; font-size: 22px; font-weight: bold;
            color: #1e293b; cursor: pointer; display: flex;
            align-items: center; justify-content: center; z-index: 10;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;
        }
        .close-popup-btn:hover {
            transform: scale(1.1); background: var(--blue-tint, #f1f5f9);
        }
        @keyframes popIn {
            to { opacity: 1; transform: scale(1); }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById('promoPopup');
            const closeBtn = document.getElementById('closePopup');
            
            // Kunci ID unik menggunakan ID dari database
            const popupId = 'bimbel_smart_promo_v_{{ $popup->id }}';

            // Cek apakah user sudah pernah menutup pop-up promo ini
            if (!localStorage.getItem(popupId)) {
                // Munculkan pop-up setelah halaman di-load (delay 1.5 detik)
                setTimeout(() => {
                    popup.classList.add('show');
                }, 1500);
            }

            // Fungsi menutup pop-up
            const closePromo = (e) => {
                if (e) e.preventDefault();
                popup.classList.remove('show');
                localStorage.setItem(popupId, 'true'); // Simpan di browser
            };

            // Tutup saat tombol X diklik
            closeBtn.addEventListener('click', closePromo);

            // Tutup saat user mengeklik area gelap di luar gambar
            popup.addEventListener('click', (e) => {
                if(e.target === popup) closePromo(e);
            });

            // Klik gambar untuk diarahkan ke kontak form
            const promoLink = popup.querySelector('a');
            promoLink.addEventListener('click', (e) => {
                // Biarkan link berjalan normal, tapi catat bahwa pop-up tidak perlu muncul lagi
                localStorage.setItem(popupId, 'true');
            });
        });
    </script>
@endif

</body>
</html>