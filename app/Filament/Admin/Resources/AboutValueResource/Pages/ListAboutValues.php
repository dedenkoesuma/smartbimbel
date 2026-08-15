<?php

namespace App\Filament\Admin\Resources\AboutValueResource\Pages;

use App\Filament\Admin\Resources\AboutValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutValues extends ListRecords
{
    protected static string $resource = AboutValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
