<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Post;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\TeamMember;
use App\Models\University;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Post::count())
                ->description('Artikel yang sudah dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning')
                ->url(route('filament.admin.resources.posts.index')),

            Stat::make('Total Galeri', Gallery::count())
                ->description('Foto kegiatan tersimpan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info')
                ->url(route('filament.admin.resources.galleries.index')),

            Stat::make('Total Program', Program::count())
                ->description('Total program bimbel terdaftar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->url(route('filament.admin.resources.programs.index')),

            Stat::make('Pesan Masuk', ContactMessage::count())
                ->description('Total pesan dari form kontak')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger')
                ->url(route('filament.admin.resources.contact-messages.index')),

            Stat::make('Tim Pengajar', TeamMember::where('is_active', true)->count())
                ->description('Anggota tim aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->url(route('filament.admin.resources.team-members.index')),

            Stat::make('Universitas Mitra', University::where('is_active', true)->count())
                ->description('Universitas terdaftar')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('gray')
                ->url(route('filament.admin.resources.universities.index')),
        ];
    }
}