<?php

namespace App\Filament\App\Resources\Plant\PlanResource\Pages;

use App\Filament\App\Resources\Plant\PlanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlan extends CreateRecord
{
    protected static string $resource = PlanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
