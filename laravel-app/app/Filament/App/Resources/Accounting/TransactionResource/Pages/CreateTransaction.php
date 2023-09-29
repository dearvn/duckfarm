<?php

namespace App\Filament\App\Resources\Accounting\TransactionResource\Pages;

use App\Filament\App\Resources\Accounting\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
