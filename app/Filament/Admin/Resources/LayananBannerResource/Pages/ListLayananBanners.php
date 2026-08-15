<?php

namespace App\Filament\Admin\Resources\LayananBannerResource\Pages;

use App\Filament\Admin\Resources\LayananBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananBanners extends ListRecords
{
    protected static string $resource = LayananBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
