<?php

namespace App\Filament\Resources\Report\CustomReportResource\Pages;

use App\Filament\Resources\Report\CustomReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomReport extends EditRecord
{
    protected static string $resource = CustomReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
