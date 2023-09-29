<?php

namespace App\Filament\App\Resources\Tool\InventoryTypeResource\Pages;

use App\Filament\App\Resources\Tool\InventoryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryTypes extends ListRecords
{
    protected static string $resource = InventoryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
