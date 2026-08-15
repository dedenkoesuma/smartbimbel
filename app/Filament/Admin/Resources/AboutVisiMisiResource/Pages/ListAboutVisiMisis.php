<?php

namespace App\Filament\Admin\Resources\AboutVisiMisiResource\Pages;

use App\Filament\Admin\Resources\AboutVisiMisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutVisiMisis extends ListRecords
{
    protected static string $resource = AboutVisiMisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
