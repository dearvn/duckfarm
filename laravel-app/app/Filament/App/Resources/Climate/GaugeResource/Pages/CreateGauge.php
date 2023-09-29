<?php

namespace App\Filament\App\Resources\Climate\GaugeResource\Pages;

use App\Filament\App\Resources\Climate\GaugeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGauge extends CreateRecord
{
    protected static string $resource = GaugeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
