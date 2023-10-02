<?php

namespace App\Filament\App\Resources\Climate\ClimateLogResource\Pages;

use App\Filament\App\Resources\Climate\ClimateLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClimateLog extends CreateRecord
{
    protected static string $resource = ClimateLogResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
