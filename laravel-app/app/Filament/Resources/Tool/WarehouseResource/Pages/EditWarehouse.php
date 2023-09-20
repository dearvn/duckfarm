<?php

namespace App\Filament\Resources\Tool\WarehouseResource\Pages;

use App\Filament\Resources\Tool\WarehouseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWarehouse extends EditRecord
{
    protected static string $resource = WarehouseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
