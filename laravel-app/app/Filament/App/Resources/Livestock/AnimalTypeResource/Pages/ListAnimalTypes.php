<?php

namespace App\Filament\App\Resources\Livestock\AnimalTypeResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimalTypes extends ListRecords
{
    protected static string $resource = AnimalTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
