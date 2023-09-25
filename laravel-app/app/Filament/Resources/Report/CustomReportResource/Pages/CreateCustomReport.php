<?php

namespace App\Filament\Resources\Report\CustomReportResource\Pages;

use App\Filament\Resources\Report\CustomReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomReport extends CreateRecord
{
    protected static string $resource = CustomReportResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
