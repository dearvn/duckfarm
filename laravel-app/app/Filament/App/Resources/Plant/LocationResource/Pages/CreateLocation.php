<?php

namespace App\Filament\App\Resources\Plant\LocationResource\Pages;

use App\Filament\App\Resources\Plant\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLocation extends CreateRecord
{
    protected static string $resource = LocationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
