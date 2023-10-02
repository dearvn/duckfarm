<?php

namespace App\Filament\App\Resources\TaskResource\Pages;

use App\Filament\App\Resources\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListTasks extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return TaskResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'To Do' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'To Do')),
            'In Progress' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'In Progress')),
            'Done' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'Done')),
            'Incomplete' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'Incomplete')),
            'Missed' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'Missed')),
            'Skipped' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'Skipped')),
        ];
    }
}
