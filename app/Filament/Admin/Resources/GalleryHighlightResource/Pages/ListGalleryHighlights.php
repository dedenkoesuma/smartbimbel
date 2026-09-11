<?php

namespace App\Filament\Admin\Resources\GalleryHighlightResource\Pages;

use App\Filament\Admin\Resources\GalleryHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryHighlights extends ListRecords
{
    protected static string $resource = GalleryHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
