<?php

namespace App\Filament\Admin\Resources\LearningVideoResource\Pages;

use App\Filament\Admin\Resources\LearningVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLearningVideo extends EditRecord
{
    protected static string $resource = LearningVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
