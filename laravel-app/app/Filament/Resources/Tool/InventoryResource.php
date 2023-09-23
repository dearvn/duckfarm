<?php

namespace App\Filament\Resources\Tool;

use App\Filament\Resources\Tool\InventoryResource\Pages;
use App\Filament\Resources\Tool\InventoryResource\RelationManagers;
use App\Models\Tool\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $slug = 'resource/inventory';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Resources';

    //protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static ?string $navigationLabel = 'Inventory';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema(static::getFormSchema()),

                Forms\Components\Section::make(trans('inventory.resource.step2'))
                    ->schema(static::getFormSchema('warehouse')),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('inventory.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_value')
                    ->label(trans('inventory.resource.unit_value'))
                    ->money()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_type.name')
                    ->label(trans('inventory.resource.type'))
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                //
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }    

    public static function getFormSchema(string $section = null): array
    {
        if ($section === 'warehouse') {
            return [
                Forms\Components\Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->searchable(),
            ];
        }

        return [

            Forms\Components\TextInput::make('name')
                ->label(trans('inventory.resource.name'))
                ->required()
                ->placeholder(trans('inventory.resource.seed'))
                ->live(onBlur: true),
            Forms\Components\Select::make('type')
                ->relationship('inventory_type', 'name')
                ->label(trans('inventory.resource.type'))
                ->searchable(),
            Forms\Components\TextInput::make('internal_id')
                ->label(trans('inventory.resource.internal_id')),

            Forms\Components\Select::make('unit')
                ->label(trans('inventory.resource.unit'))
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
            Forms\Components\TextInput::make('unit_value')
                ->label(trans('inventory.resource.unit_value'))
                ->numeric()
                ->minValue(0),
            Forms\Components\TextInput::make('unit_weight')
                ->label(trans('inventory.resource.unit_weight'))
                ->numeric()
                ->minValue(0),

            Forms\Components\Checkbox::make('track_lots')
                ->label(trans('inventory.resource.track_lots')),

            Forms\Components\TextInput::make('alert_amount')
                ->label(trans('inventory.resource.alert_amount'))
                ->numeric()
                ->minValue(0),

            Forms\Components\TextInput::make('alert_email')
                ->label(trans('inventory.resource.alert_email'))
                ->email(),

            Forms\Components\Textarea::make('description')
                ->columnSpan('full'),
        ];
    }
}
