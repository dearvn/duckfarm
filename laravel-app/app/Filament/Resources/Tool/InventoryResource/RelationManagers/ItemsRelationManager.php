<?php

namespace App\Filament\Resources\Tool\InventoryResource\RelationManagers;

use App\Models\Tool\Inventory;
use App\Models\Tool\WarehouseBin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'inventory_items';

    public string $unit;
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('inventory_id')
                            ->label(trans('inventory.resource.inventory'))
                            ->relationship('inventory', 'name')
                            ->inlineLabel()
                            ->default($this->getOwnerRecord()->id)
                            ->helperText(self::total_available($this->getOwnerRecord()->inventory_items)." ". $this->getOwnerRecord()->unit ." ".trans('inventory.resource.available'))
                            ->disabled()
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
                            ->required()
                            ->reactive()
                            ->searchable(),
                        ])->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('warehouse_bin_id')
                            ->label(trans('warehouse.resource.bin'))
                            ->inlineLabel()
                            ->required(fn (Get $get): bool => filled($get('warehouse_id')))
                            ->options(function (Get $get): array {
                                return WarehouseBin::where('warehouse_id', $get('warehouse_id'))
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->searchable(),
                        ])->hidden(fn (Get $get) => !$get('warehouse_id'))
                        ->columns(2),
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

    private static function total_available($items) {
        $total = 0;
        foreach($items as $item) {
            $total += $item->amount;
        }

        return $total;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('warehouse.name')
                    ->label(trans('warehouse.resource.warehouse'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bin.name')
                    ->label(trans('warehouse.resource.bin'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('inventory.resource.available'))
                    ->state(fn (Model $model) => $model->amount .' '. $this->getOwnerRecord()->unit)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('est_value')
                    ->label(trans('inventory.resource.est_value'))
                    ->state(fn (Model $model) => $model->amount * $this->getOwnerRecord()->unit_value)
                    ->money()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('log_date')
                    ->label(trans('warehouse.resource.log_date'))
                    ->date('d/m/Y')
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
