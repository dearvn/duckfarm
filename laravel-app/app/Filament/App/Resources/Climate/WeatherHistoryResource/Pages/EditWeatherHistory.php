<?php

namespace App\Filament\App\Resources\Climate\WeatherHistoryResource\Pages;

use App\Filament\App\Resources\Climate\WeatherHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeatherHistory extends EditRecord
{
    protected static string $resource = WeatherHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
