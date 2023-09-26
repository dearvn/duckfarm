<?php

namespace App\Filament\Resources\Livestock\AnimalTreatmentResource\Pages;

use App\Filament\Resources\Livestock\AnimalTreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimalTreatment extends EditRecord
{
    protected static string $resource = AnimalTreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
