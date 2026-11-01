<?php

namespace App\Filament\Admin\Resources\LearningVideoResource\Pages;

use App\Filament\Admin\Resources\LearningVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLearningVideos extends ListRecords
{
    protected static string $resource = LearningVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Video Baru'),
        ];
    }
}
