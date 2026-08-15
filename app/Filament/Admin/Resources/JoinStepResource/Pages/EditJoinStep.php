<?php

namespace App\Filament\Admin\Resources\JoinStepResource\Pages;

use App\Filament\Admin\Resources\JoinStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJoinStep extends EditRecord
{
    protected static string $resource = JoinStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
