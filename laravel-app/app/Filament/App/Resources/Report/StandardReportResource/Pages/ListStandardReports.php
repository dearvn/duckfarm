<?php

namespace App\Filament\App\Resources\Report\StandardReportResource\Pages;

use App\Filament\App\Resources\Report\StandardReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStandardReports extends ListRecords
{
    protected static string $resource = StandardReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
