<?php

namespace App\Filament\Admin\Resources\JoinStepResource\Pages;

use App\Filament\Admin\Resources\JoinStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJoinSteps extends ListRecords
{
    protected static string $resource = JoinStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
