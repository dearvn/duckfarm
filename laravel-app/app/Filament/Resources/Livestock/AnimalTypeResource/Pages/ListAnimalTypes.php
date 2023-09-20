<?php

namespace App\Filament\Resources\Livestock\AnimalTypeResource\Pages;

use App\Filament\Resources\Livestock\AnimalTypeResource;
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
