<?php

namespace App\Filament\Resources\Tool\WarehouseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BinsRelationManager extends RelationManager
{
    protected static string $relationship = 'bins';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('internal_id')
                    ->label(trans('warehouse.resource.internal_id'))
                    ->maxValue(50),

                Forms\Components\TextInput::make('capacity')
                    ->label(trans('warehouse.resource.capacity'))
                    ->numeric()
                    ->minValue(0),

                Forms\Components\Select::make('unit')
                    ->label(trans('warehouse.resource.unit'))
                    ->options([
                        "bales" => "bales",
                        "barrels" => "barrels",
                        "bunches" => "bunches",
                        "bushels" => "bushels",
                        "dozen" => "dozen",
                        "grams" => "grams",
                        "head" => "head",
                        "kilograms" => "kilograms",
                        "kiloliter" => "kiloliter",
                        "liter" => "liter",
                        "milliliter" => "milliliter",
                        "quantity" => "quantity",
                        "tonnes" => "tonnes"
                    ])->default("quantity"),

                Forms\Components\Textarea::make('description')
                    ->label(trans('warehouse.resource.description'))
                    ->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('warehouse.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('warehouse.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('internal_id')
                    ->label(trans('warehouse.resource.internal_id'))
                    ->searchable()
                    ->sortable()

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
