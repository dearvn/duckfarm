<?php

namespace App\Filament\App\Resources\Tool\WarehouseResource\Pages;

use App\Filament\App\Resources\Tool\WarehouseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWarehouse extends CreateRecord
{
    protected static string $resource = WarehouseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
    
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
