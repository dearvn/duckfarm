<?php

namespace App\Filament\Resources\Livestock\AnimalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'animal_treatments';

    public static function getTitle(Model $model, $title): string
    {
        return __('common.resource.treatments');
    }

    public static function getLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getPluralLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.treatments'));
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.treatments');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
