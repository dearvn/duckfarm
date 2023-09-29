<?php

namespace App\Filament\App\Resources\ContactResource\Widgets;

use App\Filament\App\Resources\ContactResource\Pages\ListContacts;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactStats extends BaseWidget
{
    //protected static string $view = 'filament.resources.contact-resource.widgets.contact-stats';

    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListContacts::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Contacts', $this->getPageTableQuery()->count()),
        ];
    }
}
