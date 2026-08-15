<?php

namespace App\Filament\Admin\Resources\PopupBannerResource\Pages;

use App\Filament\Admin\Resources\PopupBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopupBanner extends EditRecord
{
    protected static string $resource = PopupBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
