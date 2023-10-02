<?php

namespace App\Filament\App\Resources\TaskResource\Widgets;

use App\Filament\App\Resources\TaskResource\Pages\ListTasks;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TaskStats extends BaseWidget
{
    #protected static string $view = 'filament.resources.task-resource.widgets.task-stats';

    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListTasks::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Tasks', $this->getPageTableQuery()->count()),
            Stat::make('Total Done Task', $this->getPageTableQuery()->where('status', 'Done')->count()),
            Stat::make('Total In Progress', $this->getPageTableQuery()->where('status', 'In Progress')->count()),
        ];
    }
}
