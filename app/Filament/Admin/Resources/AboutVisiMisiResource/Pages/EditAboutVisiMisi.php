<?php

namespace App\Filament\Admin\Resources\AboutVisiMisiResource\Pages;

use App\Filament\Admin\Resources\AboutVisiMisiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutVisiMisi extends EditRecord
{
    protected static string $resource = AboutVisiMisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
