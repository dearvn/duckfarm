<?php

namespace App\Filament\App\Resources\Plant\LocationResource\Pages;

use App\Filament\App\Resources\Plant\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocation extends EditRecord
{
    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
