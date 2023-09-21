<?php

namespace App\Filament\Resources\Plant\CropTypeResource\Pages;

use App\Filament\Resources\Plant\CropTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCropType extends EditRecord
{
    protected static string $resource = CropTypeResource::class;

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
