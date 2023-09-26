<?php

namespace App\Filament\Resources\Tool;

use App\Filament\Resources\Tool\InventoryResource\Pages;
use App\Filament\Resources\Tool\InventoryResource\RelationManagers;
use App\Filament\Resources\Tool\InventoryResource\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\Tool\InventoryResource\RelationManagers\LogsRelationManager;
use App\Models\Tool\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.resources');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.inventory');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.inventory');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.inventory'));
    }

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
                Tables\Columns\TextColumn::make('inventory_type.name')
                    ->label(trans('inventory.resource.type'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_items_sum_amount')
                    ->label(trans('inventory.resource.available'))
                    ->sum('inventory_items', 'amount')
                    ->state(fn (Model $model) => ($model->inventory_items_sum_amount  ? $model->inventory_items_sum_amount : '0') .' '. $model->unit)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('est_value')
                    ->label(trans('inventory.resource.est_value'))
                    ->state(fn (Model $model) => $model->inventory_items_sum_amount * $model->unit_value)
                    ->money()
                    ->searchable()
                    ->sortable(),
            ])
            //->defaultGroup('type')
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
            ItemsRelationManager::make([
                'title' => ''
            ]),
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
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->label(trans('inventory-type.resource.name'))
                        ->required()
                        ->maxValue(50)
                        ->live(onBlur: true),
                    Forms\Components\Textarea::make('description')
                        ->label(trans('common.resource.description'))
                        ->columnSpan('full'),
                ])
                ->createOptionAction(
                    function (Forms\Components\Actions\Action $action, Get $get) { 
                        return $action
                            ->modalWidth('3xl')
                            ->modalHeading(trans('inventory.resource.create new inventory type'));

                })
                ->label(trans('inventory.resource.type'))
                ->searchable(),
            Forms\Components\TextInput::make('internal_id')
                ->label(trans('inventory.resource.internal_id')),

            Forms\Components\Select::make('unit')
                ->label(trans('inventory.resource.unit'))
                ->options([
                    "bales" => trans("options.bales"),
                    "barrels" => trans("options.barrels"),
                    "bunches" => trans("options.bunches"),
                    "bushels" => trans("options.bushels"),
                    "dozen" => trans("options.dozen"),
                    "grams" => trans("options.grams"),
                    "head" => trans("options.head"),
                    "kilograms" => trans("options.kilograms"),
                    "kiloliter" => trans("options.kiloliter"),
                    "liter" => trans("options.liter"),
                    "milliliter" => trans("options.milliliter"),
                    "quantity" => trans("options.quantity"),
                    "tonnes" => trans("options.tonnes")
                ])->default("quantity"),
            Forms\Components\TextInput::make('unit_value')
               ->label(trans('inventory.resource.unit_value'))
                ->numeric()
                ->prefix(trans('common.resource.currency_symbol'))
                ->minValue(0),
            Forms\Components\TextInput::make('unit_weight')
                ->label(trans('inventory.resource.unit_weight'))
                ->numeric()
                ->postfix(trans('common.resource.kg'))
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

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
