<?php

namespace App\Filament\Admin\Resources\LayananProgramResource\Pages;

use App\Filament\Admin\Resources\LayananProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananPrograms extends ListRecords
{
    protected static string $resource = LayananProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
