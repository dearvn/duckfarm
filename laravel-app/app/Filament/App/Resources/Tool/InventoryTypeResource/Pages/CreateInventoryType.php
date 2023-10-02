<?php

namespace App\Filament\App\Resources\Tool\InventoryTypeResource\Pages;

use App\Filament\App\Resources\Tool\InventoryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventoryType extends CreateRecord
{
    protected static string $resource = InventoryTypeResource::class;

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
