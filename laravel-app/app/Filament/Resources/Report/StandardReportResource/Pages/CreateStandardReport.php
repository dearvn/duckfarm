<?php

namespace App\Filament\Resources\Report\StandardReportResource\Pages;

use App\Filament\Resources\Report\StandardReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStandardReport extends CreateRecord
{
    protected static string $resource = StandardReportResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
