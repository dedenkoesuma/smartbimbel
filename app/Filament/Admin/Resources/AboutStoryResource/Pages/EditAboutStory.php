<?php

namespace App\Filament\Admin\Resources\AboutStoryResource\Pages;

use App\Filament\Admin\Resources\AboutStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutStory extends EditRecord
{
    protected static string $resource = AboutStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
