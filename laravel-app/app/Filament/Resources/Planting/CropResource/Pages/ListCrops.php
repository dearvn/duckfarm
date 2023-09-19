<?php

namespace App\Filament\Resources\Planting\CropResource\Pages;

use App\Filament\Resources\Planting\CropResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrops extends ListRecords
{
    protected static string $resource = CropResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
