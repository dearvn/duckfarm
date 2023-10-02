<?php

namespace App\Filament\App\Resources\Tool\WarehouseResource\Pages;

use App\Filament\App\Resources\Tool\WarehouseResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditWarehouse extends EditRecord
{
    protected static string $resource = WarehouseResource::class;

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

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return false;
    }
}
