<?php

namespace App\Filament\Resources\Planting\CropResource\Pages;

use App\Filament\Resources\Planting\CropResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrop extends EditRecord
{
    protected static string $resource = CropResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
