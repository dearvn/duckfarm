<?php

namespace App\Filament\Resources\Livestock\AnimalResource\RelationManagers;

use App\Models\Tool\InventoryLocation;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'animal_treatments';

    public static function getTitle(Model $model, $title): string
    {
        return __('common.resource.treatments');
    }

    public static function getLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getPluralLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.treatments');
    }

    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.treatments'));
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.treatments');
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
                Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('type')
                        ->label(trans('animal-treatments.resource.type'))
                        ->options([
                            'Alternative Therapy'=> trans("options.alternative_therapy"),
                            'Artificial Insemination'=> trans("options.artificial_insemination"),
                            'Branding'=> trans("options.branding"),
                            'Castration'=> trans("options.castration"),
                            'Dehorning'=> trans("options.dehorning"),
                            'Dental Procedure'=> trans("options.dental_procedure"),
                            'Deworming'=> trans("options.deworming"),
                            'Ear Notching'=> trans("options.ear_notching"),
                            'Euthanasia'=> trans("options.euthanasia"),
                            'Fly Treatment'=> trans("options.fly_treatment"),
                            'Grooming'=> trans("options.grooming"),
                            'Hoof Trim'=> trans("options.hoof_trim"),
                            'Medication'=> trans("options.medication"),
                            'Mites'=> trans("options.mites"),
                            'Parasite Treatment'=> trans("options.parasite_treatment"),
                            'Surgical Procedure'=> trans("options.surgical_procedure"),
                            'Tagging'=> trans("options.tagging"),
                            'Tattoo'=> trans("options.tattoo"),
                            'Vaccination'=> trans("options.vaccination"),
                            'Other Procedure'=> trans("options.other_procedure")
                        ])
                        ->preload(),
                    ])->columns(1),


                    Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('product')
                            ->label(trans('animal-treatments.resource.product')),
                        Forms\Components\TextInput::make('batch')
                            ->label(trans('animal-treatments.resource.batch')),
                        Forms\Components\TextInput::make('inventory_amount')
                            ->label(trans('animal-treatments.resource.inventory_amount')),
                    ]),

                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('location_id')
                            ->label(trans('animal-treatments.resource.location_id'))
                            ->options($options)
                            ->searchable()
                            ->reactive()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label(trans('animal-treatments.resource.amount'))
                            ->numeric()
                            ->required()
                            ->postfix(fn (Get $get): string => ($get('location_id') ? trans('options.'.$units[$get('location_id')]) : ''))
                            ->helperText(fn (Get $get): string => ($get('location_id') ?  trans('common.resource.max')." ".($get('id') ? $rest_amounts[$get('location_id')] + $get('amount'): $rest_amounts[$get('location_id')])." ".trans('options.'.$units[$get('location_id')]) : ''))
                            ->minValue(0)
                            ->maxValue(fn (Get $get): string => ($get('location_id') ? ($get('id') ? $rest_amounts[$get('location_id')] + $get('amount'): $rest_amounts[$get('location_id')]) : 0))
                            ,
                    ]),

                    Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('mode')
                            ->label(trans('animal-treatments.resource.mode'))
                            ->options([
                                'Intramuscular (in the muscle)'=> trans("options.intramuscular"),
                                'Intramammary (in the udder)'=> trans("options.intramammary"),
                                'Intrauterine (in the uterus)'=> trans("options.intrauterine"),
                                'Intravenous (in the vein)'=> trans("options.intravenous"),
                                'Oral (in the mouth)'=> trans("options.oral"),
                                'Subcutaneous (under the skin)'=> trans("options.subcutaneous"),
                                'Topical (on the skin)'=> trans("options.topical"),
                                'Other'=> trans("options.other")
                            ])
                            ->preload(),

                        Forms\Components\TextInput::make('site')
                            ->label(trans('animal-treatments.resource.site'))
                            ->placeholder(trans('animal-treatments.resource.rump')),

                    ]),

                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('days_to_withdrawal')
                            ->label(trans('animal-treatments.resource.days_to_withdrawal'))
                            ->numeric(),
                        Forms\Components\DatePicker::make('retreat_date')
                            ->label(trans('animal-treatments.resource.retreat_date')),
                        
                    ]),

                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('technician')
                            ->label(trans('animal-treatments.resource.technician'))
                            ->placeholder(trans('animal-treatments.resource.alpine')),
                        Forms\Components\TextInput::make('cost')
                            ->label(trans('animal-treatments.resource.cost'))
                            ->numeric()
                            ->prefix(trans('common.resource.currency_symbol')),
                        Forms\Components\Checkbox::make('record_transaction')
                            ->label(trans('animal-treatments.resource.record_transaction')),
                    ]),

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label(trans('common.resource.description'))
                            
                    ])->columnSpanFull(),

                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label(trans('animal-treatments.resource.date'))
                            ->default(now()),
                        TagsInput::make('keywords')
                            ->label(trans('animal.resource.keywords'))
                            ->placeholder(trans('animal.resource.calf'))
                    ]),

                ]),


               

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('d/m/Y')
                    ->label(trans('animal-treatments.resource.date'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('animal-treatments.resource.type'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product')
                    ->label(trans('animal-treatments.resource.product'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('days_to_withdrawal')
                    ->label(trans('animal-treatments.resource.days_to_withdrawal'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('retreat_date')
                    ->date('d/m/Y')
                    ->label(trans('animal-treatments.resource.retreat_date'))
                    ->searchable()
                    ->sortable(),
                /*Tables\Columns\TextColumn::make('created_by')
                    ->label(trans('common.resource.created_by'))
                    ->state(fn (Model $model) => $model->created_by ? $model->created_by->name : '')
                    ->searchable()
                    ->sortable(),*/
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
    
        return $data;
    }
}
