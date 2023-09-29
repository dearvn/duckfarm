<?php

namespace App\Filament\App\Resources\Climate\ClimateLogResource\Pages;

use App\Filament\App\Resources\Climate\ClimateLogResource;
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
