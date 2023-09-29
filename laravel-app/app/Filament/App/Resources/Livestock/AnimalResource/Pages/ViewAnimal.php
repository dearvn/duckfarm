<?php

namespace App\Filament\App\Resources\Livestock\AnimalResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalResource;
use App\Filament\App\Resources\Livestock\AnimalResource\RelationManagers\NotesRelationManager;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ViewRecord;

class ViewAnimal extends ViewRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),

                
            ])->button()
            ->label(trans('actions.buttons.record_activity')),

            Actions\EditAction::make(),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ])->icon('heroicon-m-ellipsis-horizontal')
        ];
    }

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
