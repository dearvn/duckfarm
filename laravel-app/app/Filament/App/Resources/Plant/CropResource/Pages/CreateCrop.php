<?php

namespace App\Filament\App\Resources\Plant\CropResource\Pages;

use App\Filament\App\Resources\Plant\CropResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCrop extends CreateRecord
{
    protected static string $resource = CropResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
