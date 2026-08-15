<?php

namespace App\Filament\Admin\Resources\LayananProgramResource\Pages;

use App\Filament\Admin\Resources\LayananProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananProgram extends EditRecord
{
    protected static string $resource = LayananProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
