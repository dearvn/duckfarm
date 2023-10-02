<?php

namespace App\Filament\App\Resources\Livestock\AnimalTypeResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimalType extends EditRecord
{
    protected static string $resource = AnimalTypeResource::class;

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
