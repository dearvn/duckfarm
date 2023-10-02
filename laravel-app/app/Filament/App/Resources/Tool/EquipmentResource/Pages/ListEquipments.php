<?php

namespace App\Filament\App\Resources\Tool\EquipmentResource\Pages;

use App\Filament\App\Resources\Tool\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEquipments extends ListRecords
{
    protected static string $resource = EquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
