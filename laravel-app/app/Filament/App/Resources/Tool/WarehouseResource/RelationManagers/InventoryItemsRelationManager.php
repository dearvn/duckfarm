<?php

namespace App\Filament\App\Resources\Tool\WarehouseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'inventory_items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('inventory_id')
                            ->relationship('inventory', 'name')
                            ->inlineLabel()
                            ->required()
                            ->searchable(),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label(trans('warehouse.resource.add'))
                            ->inlineLabel()
                            ->numeric()
                            ->required()
                            ->postfix($this->getOwnerRecord()->unit)
                            ->minValue(0),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('log_date')
                            ->label(trans('warehouse.resource.log_date'))
                            ->inlineLabel()
                            ->required()
                            ->default(now())
                            ->placeholder('dd/mm/yyyy'),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('warehouse_id')
                            ->relationship('warehouse', 'name')
                            ->label(trans('warehouse.resource.warehouse'))
                            ->inlineLabel()
                            ->searchable(),
                        ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('warehouse_bin_id')
                            ->label(trans('warehouse.resource.bin'))
                            ->inlineLabel()
                            ->relationship('bin', 'name')
                            ->searchable(),
                        ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('source')
                        ->inlineLabel()
                        ->label(trans('warehouse.resource.source')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Textarea::make('reason')
                            ->inlineLabel()
                            ->label(trans('warehouse.resource.reason'))
                    ])->columns(2),
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('inventory.name')
                    ->label(trans('invetory.resource.inventory'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('warehouse.resource.amount'))
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
