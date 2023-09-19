<?php

namespace App\Filament\Resources\Climate\ClimateLogResource\Pages;

use App\Filament\Resources\Climate\ClimateLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClimateLog extends EditRecord
{
    protected static string $resource = ClimateLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
