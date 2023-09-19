<?php

namespace App\Filament\Resources\Climate\ClimateLogResource\Pages;

use App\Filament\Resources\Climate\ClimateLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClimateLogs extends ListRecords
{
    protected static string $resource = ClimateLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
