<?php

namespace App\Filament\Resources\Livestock\AnimalResource\RelationManagers;

use App\Models\Tool\Inventory;
use App\Models\Tool\InventoryItem;
use App\Models\Tool\InventoryLocation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
        $locations = InventoryLocation::all();
        $options = [];
        $units = [];
        $rest_amounts = [];
        foreach($locations as $item) {
            $inventory_name = $item->inventory_name;
            if (!isset($options[$inventory_name])) {
                $options[$inventory_name] = [];
            }
            $amount = $item->amount - ($item->input_amount + $item->feeding_amount + $item->treatment_amount);
            $options[$inventory_name][$item->location_id] = $inventory_name." ".trans('common.resource.from')." ".$item->warehouse_name." : " .$item->bin_name. " (".$amount." ".trans("options.{$item->unit}").")";

            $units[$item->location_id] = $item->unit;
            $rest_amounts[$item->location_id] = $amount;
        }

        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('location_id')
                            ->label(trans('animal-inputs.resource.location_id'))
                            ->options($options)
                            ->inlineLabel()
                            ->searchable()
                            ->reactive()
                            ->preload()
                            /*->afterStateUpdated(function (Set $set, Get $get) {
                                $set('unit', $units[$get('location_id')]);
                            })*/
                    ])->columns(2),      
                    
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label(trans('animal-inputs.resource.amount'))
                            ->inlineLabel()
                            ->numeric()
                            ->required()
                            ->postfix(fn (Get $get): string => ($get('location_id') ? trans('options.'.$units[$get('location_id')]) : ''))
                            ->helperText(fn (Get $get): string => ($get('location_id') ? trans('common.resource.max')." ".$rest_amounts[$get('location_id')]." ".trans('options.'.$units[$get('location_id')]) : ''))
                            ->minValue(0)
                            ->maxValue(fn (Get $get): string => ($get('location_id') ? $rest_amounts[$get('location_id')] : 0)),
                        
                        /*Forms\Components\Select::make('unit')
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
                            ->preload()
                            //->disabled()
                            //->state(fn (Get $get): string => (!empty($get('location_id')) ? $units[$get('location_id')] : ''))
                            ->default(fn (Get $get): string => $get('location_id') ? $units[$get('location_id')] : '')
                        */
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
                Tables\Columns\TextColumn::make('location_id')
                ->label(trans('animal-inputs.resource.location_id'))
                    ->state(fn (Model $model) => $model->inventory_location ? $model->inventory_location->inventory_name." - ".$model->inventory_location->warehouse_name." : ".$model->inventory_location->bin_name: '')
                    ->searchable()
                    ->sortable(),
               
                Tables\Columns\TextColumn::make('amount')
                    ->label(trans('animal-inputs.resource.amount'))
                    ->state(fn (Model $model) => $model->amount ." ". trans("options.{$model->inventory_location->unit}"))
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
