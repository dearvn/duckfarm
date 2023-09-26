<?php

namespace App\Filament\Resources\Livestock\AnimalResource\RelationManagers;

use App\Models\Tool\Inventory;
use App\Models\Tool\InventoryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class InputsRelationManager extends RelationManager
{
    protected static string $relationship = 'animal_inputs';

    public static function getTitle(Model $model, $title): string
    {
        return __('common.resource.inputs');
    }

    public static function getLabel(): string
    {
        return __('common.resource.inputs');
    }

    public static function getPluralLabel(): string
    {
        return __('common.resource.inputs');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.inputs');
    }

    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.inputs'));
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.inputs');
    }

    public function form(Form $form): Form
    {
        $inventories = Inventory::all();
        $options = [];
        foreach($inventories as $inventory) {
            if (empty($inventory->inventory_items) || empty($inventory->inventory_type)) {
                continue;
            }

            $inventory_name = $inventory->name."(".$inventory->inventory_type->name.")";
            if (!isset($options[$inventory_name])) {
                $options[$inventory_name] = [];
            }
            foreach($inventory->inventory_items as $item) {
                if (empty($item->warehouse->name) || empty($item->bin->name)) {
                    continue;
                }
                $options[$inventory_name][$item->id] = $inventory->name." - ".$item->warehouse->name." : " .$item->bin->name;
            }
        }

        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('location_id')
                            ->label(trans('animal-inputs.resource.location_id'))
                            ->options($options)
                            ->inlineLabel()
                            ->searchable(),
                    ])->columns(2),      
                    
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label(trans('animal-inputs.resource.amount'))
                            ->inlineLabel()
                            ->numeric()
                            ->required()
                            ->minValue(0),
                        
                        Forms\Components\Select::make('unit')
                            ->inlineLabel()
                            ->hiddenLabel()
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
                            ])
                    ])->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('type')
                        ->inlineLabel()
                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: trans('animal-inputs.resource.type_hint'))
                        ->label(trans('animal-inputs.resource.type')),
                    ])->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('cost')
                            ->label(trans('animal-inputs.resource.cost'))
                            ->inlineLabel()
                            ->numeric()
                            ->required()
                            ->prefix(trans('common.resource.currency_symbol'))
                            ->minValue(0),
                    ])->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Textarea::make('description')
                            ->inlineLabel()
                            ->label(trans('animal-inputs.resource.description'))
                    ])->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label(trans('animal-inputs.resource.date'))
                            ->inlineLabel()
                            ->required()
                            ->default(now())
                            ->placeholder('dd/mm/yyyy'),
                    ])->columns(2),
                    
                ])->columnSpanFull()
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('gender')
                ->label(trans('animal-inputs.resource.location_id'))
                    ->state(fn (Model $model) => $model->inventory_item ? $model->inventory_item->inventory->name.' '.$model->inventory_item->warehouse->name.' - '.$model->inventory_item->bin->name: '')
                    ->searchable()
                    ->sortable(),
               
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('animal-inputs.resource.amount'))
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('animal-inputs.resource.type'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cost')
                    ->label(trans('animal-inputs.resource.cost'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->label(trans('animal-inputs.resource.date'))
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
