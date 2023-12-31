<?php

namespace App\Filament\App\Resources\Livestock\AnimalTypeResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimalType extends CreateRecord
{
    protected static string $resource = AnimalTypeResource::class;

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
