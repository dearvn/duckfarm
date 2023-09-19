<?php

namespace App\Filament\Resources\Report\CustomReportResource\Pages;

use App\Filament\Resources\Report\CustomReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomReports extends ListRecords
{
    protected static string $resource = CustomReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
