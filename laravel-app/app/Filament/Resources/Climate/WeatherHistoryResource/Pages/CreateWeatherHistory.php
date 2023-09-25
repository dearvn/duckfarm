<?php

namespace App\Filament\Resources\Climate\WeatherHistoryResource\Pages;

use App\Filament\Resources\Climate\WeatherHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWeatherHistory extends CreateRecord
{
    protected static string $resource = WeatherHistoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
