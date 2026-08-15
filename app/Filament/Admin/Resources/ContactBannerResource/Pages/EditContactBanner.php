<?php

namespace App\Filament\Admin\Resources\ContactBannerResource\Pages;

use App\Filament\Admin\Resources\ContactBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactBanner extends EditRecord
{
    protected static string $resource = ContactBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
