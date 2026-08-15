<?php

namespace App\Filament\Admin\Resources\ContactBannerResource\Pages;

use App\Filament\Admin\Resources\ContactBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactBanners extends ListRecords
{
    protected static string $resource = ContactBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
