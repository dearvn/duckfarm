<?php

namespace App\Filament\Resources\Resource\EquipmentResource\Pages;

use App\Filament\Resources\Resource\EquipmentResource;
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
