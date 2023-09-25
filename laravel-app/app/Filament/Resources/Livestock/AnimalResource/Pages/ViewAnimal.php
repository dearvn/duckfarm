<?php

namespace App\Filament\Resources\Livestock\AnimalResource\Pages;

use App\Filament\Resources\Livestock\AnimalResource;
use App\Filament\Resources\Livestock\AnimalResource\RelationManagers\NotesRelationManager;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ViewRecord;

class ViewAnimal extends ViewRecord
{
    protected static string $resource = AnimalResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Detail'),
            
        ];
    }

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return true;
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            NotesRelationManager::class,
        ];
    }
}
