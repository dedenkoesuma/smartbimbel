<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Bimbel Smart')
            ->brandLogo(asset('assets/logo.png'))
            ->darkModeBrandLogo(asset('assets/logo-light.png'))
            ->brandLogoHeight('4.0rem')
            ->colors([
                'primary' => [
                    50  => '#fffbeb',
                    100 => '#fef3c7',
                    200 => '#fde68a',
                    300 => '#fcd34d',
                    400 => '#fbbf24',
                    500 => '#ffb703', // gold/kuning utama, samakan dengan --gold di frontend
                    600 => '#d99a00',
                    700 => '#b37e00',
                    800 => '#8c6300',
                    900 => '#664700',
                    950 => '#402c00',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
               \App\Filament\Admin\Widgets\DashboardStats::class,
            ])
            ->navigationGroups([
                'Promo',
                'Data Masuk',
                'Halaman Beranda',
                'Halaman Tentang Kami',
                'Halaman Layanan',
                'Halaman Galeri',
                'Halaman Blog',
                'Halaman Kontak',
                'Pengaturan Tampilan',
                'Pengaturan Akun',
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
