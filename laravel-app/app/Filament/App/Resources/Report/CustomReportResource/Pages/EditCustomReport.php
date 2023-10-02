<?php

namespace App\Filament\App\Resources\Report\CustomReportResource\Pages;

use App\Filament\App\Resources\Report\CustomReportResource;
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
