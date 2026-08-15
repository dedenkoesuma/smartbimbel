<?php

namespace App\Filament\Admin\Resources\LayananBannerResource\Pages;

use App\Filament\Admin\Resources\LayananBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananBanner extends EditRecord
{
    protected static string $resource = LayananBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
