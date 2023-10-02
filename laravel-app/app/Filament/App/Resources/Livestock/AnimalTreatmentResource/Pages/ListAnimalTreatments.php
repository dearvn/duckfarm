<?php

namespace App\Filament\App\Resources\Livestock\AnimalTreatmentResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalTreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimalTreatments extends ListRecords
{
    protected static string $resource = AnimalTreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
