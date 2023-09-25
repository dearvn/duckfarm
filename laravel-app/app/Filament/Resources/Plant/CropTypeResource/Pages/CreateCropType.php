<?php

namespace App\Filament\Resources\Plant\CropTypeResource\Pages;

use App\Filament\Resources\Plant\CropTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCropType extends CreateRecord
{
    protected static string $resource = CropTypeResource::class;

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
