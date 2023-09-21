<?php

namespace App\Filament\Resources\Plant\CropTypeResource\Pages;

use App\Filament\Resources\Plant\CropTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCropTypes extends ListRecords
{
    protected static string $resource = CropTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
