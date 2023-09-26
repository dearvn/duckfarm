<?php

namespace App\Filament\Resources\Tool;

use App\Filament\Resources\Tool\WarehouseResource\Pages;
use App\Filament\Resources\Tool\WarehouseResource\RelationManagers;
use App\Models\Tool\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarehouseResource extends Resource
{
    protected static ?string $model = Warehouse::class;

    protected static ?string $slug = 'resource/warehouse';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Resources';

    //protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static ?string $navigationLabel = 'Warehouses';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.resources');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.warehouses');
    }


    public static function getPluralModelLabel(): string
    {
        return __('common.resource.warehouses');
    }

    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.warehouses'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('warehouse.resource.name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('internal_id')
                    ->label(trans('warehouse.resource.internal_id'))
                    ->maxValue(50),
                Forms\Components\Textarea::make('description')
                    ->label(trans('warehouse.resource.description'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
    
    public static function getRelations(): array
    {
        return [
            RelationGroup::make('Bins', [
                RelationManagers\BinsRelationManager::class,
            ]),
            RelationGroup::make('Inventory', [
                RelationManagers\InventoryItemsRelationManager::class,
            ])
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarehouses::route('/'),
            'create' => Pages\CreateWarehouse::route('/create'),
            'edit' => Pages\EditWarehouse::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
