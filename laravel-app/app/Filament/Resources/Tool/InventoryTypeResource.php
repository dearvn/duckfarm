<?php

namespace App\Filament\Resources\Tool;

use App\Filament\Resources\Tool\InventoryTypeResource\Pages;
use App\Filament\Resources\Tool\InventoryTypeResource\RelationManagers;
use App\Models\Tool\InventoryType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryTypeResource extends Resource
{
    protected static ?string $model = InventoryType::class;

    protected static ?string $slug = 'resource/inventory-type';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Resources';

    //protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static ?string $navigationLabel = 'Inventory Types';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.resources');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.inventory_types');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.inventory_types');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.inventory_types'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('inventory-type.resource.name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\Textarea::make('description')
                    ->label(trans('common.resource.description'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('inventory-type.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('inventory-type.resource.name'))
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventoryTypes::route('/'),
            'create' => Pages\CreateInventoryType::route('/create'),
            'edit' => Pages\EditInventoryType::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
