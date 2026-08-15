<?php

namespace App\Filament\Admin\Resources\WhyUsSectionResource\Pages;

use App\Filament\Admin\Resources\WhyUsSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhyUsSection extends EditRecord
{
    protected static string $resource = WhyUsSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
