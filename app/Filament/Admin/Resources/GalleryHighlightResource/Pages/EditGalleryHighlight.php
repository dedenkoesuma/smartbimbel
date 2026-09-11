<?php

namespace App\Filament\Admin\Resources\GalleryHighlightResource\Pages;

use App\Filament\Admin\Resources\GalleryHighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryHighlight extends EditRecord
{
    protected static string $resource = GalleryHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
