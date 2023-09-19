<?php

namespace App\Filament\Resources\Report\StandardReportResource\Pages;

use App\Filament\Resources\Report\StandardReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStandardReport extends EditRecord
{
    protected static string $resource = StandardReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
