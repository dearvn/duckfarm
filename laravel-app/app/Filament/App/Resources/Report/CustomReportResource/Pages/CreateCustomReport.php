<?php

namespace App\Filament\App\Resources\Report\CustomReportResource\Pages;

use App\Filament\App\Resources\Report\CustomReportResource;
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
