<?php

namespace App\Filament\Admin\Resources\AdditionalServiceResource\Pages;

use App\Filament\Admin\Resources\AdditionalServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalServices extends ListRecords
{
    protected static string $resource = AdditionalServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
