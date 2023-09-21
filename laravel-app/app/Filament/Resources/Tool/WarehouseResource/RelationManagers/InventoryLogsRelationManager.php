<?php

namespace App\Filament\Resources\Tool\WarehouseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'inventory_logs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inventory_id')
                    ->relationship('inventory', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('amount')
                    ->label(trans('warehouse.resource.add'))
                    ->numeric()
                    ->minValue(0),
                Forms\Components\DatePicker::make('log_date')
                    ->label(trans('warehouse.resource.log_date'))
                    ->placeholder('dd/mm/yyyy'),
                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->searchable(),
                Forms\Components\Select::make('warehouse_bin_id')
                    ->relationship('bin', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('source')
                    ->label(trans('warehouse.resource.source')),
                Forms\Components\Textarea::make('reason')
                    ->label(trans('warehouse.resource.reason'))
                    ->columnSpan('full'),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('inventory.name')
                    ->label(trans('warehouse.resource.inventory'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bin.name')
                    ->label(trans('warehouse.resource.inventory'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('warehouse.resource.amount'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('warehouse.resource.amount'))
                    ->money()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('log_date')
                    ->label(trans('warehouse.resource.log_date'))
                    ->date('m/d/Y')
                    ->searchable()
                    ->sortable(),
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
