<?php

namespace App\Filament\App\Resources\Tool\InventoryTypeResource\Pages;

use App\Filament\App\Resources\Tool\InventoryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryType extends EditRecord
{
    protected static string $resource = InventoryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
    
        return $data;
    }
}
