<?php

namespace App\Filament\Resources\Climate\GaugeResource\Pages;

use App\Filament\Resources\Climate\GaugeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGauges extends ListRecords
{
    protected static string $resource = GaugeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
