<?php

namespace App\Filament\App\Resources\Plant\CropTypeResource\Pages;

use App\Filament\App\Resources\Plant\CropTypeResource;
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
