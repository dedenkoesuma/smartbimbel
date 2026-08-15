<?php

namespace App\Filament\Admin\Resources\AboutBannerResource\Pages;

use App\Filament\Admin\Resources\AboutBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutBanners extends ListRecords
{
    protected static string $resource = AboutBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
