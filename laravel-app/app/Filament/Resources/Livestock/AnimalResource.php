<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\AnimalResource\Pages;
use App\Filament\Resources\Livestock\AnimalResource\RelationManagers;
use App\Models\Livestock\Animal;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $slug = 'livestock/animals';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Livestock';

    ////protected static ?string $navigationIcon = 'heroicon-o-key';

    //protected static ?string $navigationLabel = 'Animals';

    protected static ?int $navigationSort = 1;

    protected static ?int $navigationGroupSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(trans('animal.resource.basic'))
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(trans('animal.resource.name'))
                        ->required()
                        ->live(onBlur: true),
                    Forms\Components\Select::make('type')
                        ->relationship('animal_type', 'name')
                        ->searchable(),
                    Forms\Components\TextInput::make('breed')
                        ->label(trans('animal.resource.breed'))
                        ->placeholder(trans('animal.resource.breed')),

                    Forms\Components\Select::make('gender')
                        ->label(trans('animal.resource.gender'))
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ]),
                    TagsInput::make('keywords')
                        ->label(trans('animal.resource.keywords'))
                        ->placeholder(trans('animal.resource.calf')),

                    Forms\Components\TextInput::make('internal_id')
                        ->label(trans('animal.resource.internal_id'))
                        ->placeholder(trans('animal.resource.example')),

                    Forms\Components\Select::make('status')
                        ->label(trans('animal.resource.status'))
                        ->options([
                            'Active' => 'Active',
                            'Butchered' => 'Butchered',
                            'Culled' => 'Culled',
                            'Deceased' => 'Deceased',
                            'Dry' => 'Dry',
                            'Finishing' => 'Finishing',
                            'For Sale' => 'For Sale',
                            'Lactating' => 'Lactating',
                            'Lost' => 'Lost',
                            'Off Farm' => 'Off Farm',
                            'Quarantined' => 'Quarantined',
                            'Reference' => 'Reference',
                            'Sick' => 'Sick',
                            'Sold' => 'Sold',
                            'Weaning' => 'Weaning',
                            'Archived' => 'Archived'
                        ])->live(),
                    
                ])
                ->columns(3),

                Forms\Components\Section::make(trans('animal.resource.physical'))
                ->schema([
                    Forms\Components\Checkbox::make('is_neutered')
                        ->label(trans('animal.resource.is_neutered')),

                    Forms\Components\Checkbox::make('breeding_stock')
                        ->label(trans('animal.resource.breeding_stock')),

                    Forms\Components\TextInput::make('coloring')
                        ->label(trans('animal.resource.coloring'))
                        ->placeholder(trans('animal.resource.brown')),

                    Forms\Components\TextInput::make('retention_score')
                        ->label(trans('animal.resource.retention_score')),

                    Forms\Components\Textarea::make('description')
                        ->label(trans('animal.resource.description'))
                        ->columnSpan('full'),
                ])
                ->columns(2),

                Forms\Components\Section::make(trans('animal.resource.identification'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('tag_number')
                            ->label(trans('animal.resource.tag_number')),

                        Forms\Components\TextInput::make('tag_color')
                            ->label(trans('animal.resource.tag_color')),

                        Forms\Components\Select::make('tag_location')
                            ->label(trans('animal.resource.tag_location'))
                            ->options([
                                'Left Ear' => 'Left Ear',
                                'Right Ear' => 'Right Ear'
                            ]),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('other_tag_number')
                            ->label(trans('animal.resource.other_tag_number')),

                        Forms\Components\TextInput::make('other_tag_color')
                            ->label(trans('animal.resource.other_tag_color')),

                        Forms\Components\Select::make('other_tag_location')
                            ->label(trans('animal.resource.other_tag_location'))
                            ->options([
                                'Left Ear' => 'Left Ear',
                                'Right Ear' => 'Right Ear'
                            ]),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('electronic_id')
                            ->label(trans('animal.resource.electronic_id'))->columns(1),
                        Forms\Components\TextInput::make('registry_number')
                            ->label(trans('animal.resource.registry_number'))->columns(1),
                    ])->columns(3),
                    
                    Forms\Components\Group::make()->schema([
                        
                        Forms\Components\TextInput::make('tattoo_left')
                            ->label(trans('animal.resource.tattoo_left')),

                        Forms\Components\TextInput::make('tattoo_right')
                            ->label(trans('animal.resource.tattoo_right')),
                    ])
                    ->label(trans('animal.resource.tattoos'))
                    ->columns(3),

                ]),

                Forms\Components\Section::make(trans('animal.resource.birth'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('birth_date')
                            ->label(trans('animal.resource.birth_date'))->columns(1),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('mother')
                            ->relationship('animal_mother', 'name')
                            ->searchable(),
                        Forms\Components\Select::make('father')
                            ->relationship('animal_father', 'name')
                            ->searchable(),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('birth_weight')
                            ->postfix(trans('animal.resource.kg'))
                            ->numeric()
                            ->label(trans('animal.resource.birth_weight')),

                        Forms\Components\TextInput::make('days_to_wean')
                            ->postfix(trans('animal.resource.days'))
                            ->numeric()
                            ->label(trans('animal.resource.days_to_wean')),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('weaned_date')
                            ->label(trans('animal.resource.weaned_date'))->columns(1),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Radio::make('purchased')
                            ->label(trans('animal.resource.purchased'))
                            ->options([
                                'Raised' => 'Raised',
                                'Purchased' => 'Purchased'
                            ])
                            ->default('Raised')
                            ->live()
                            ->columns(1),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('purchase_date')
                            ->label(trans('animal.resource.purchase_date'))->columns(1),
                    
                        Forms\Components\TextInput::make('purchase_price')
                            ->label(trans('animal.resource.purchase_price'))
                            ->numeric()
                            ->columns(1),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(3),
                    
                    Forms\Components\Group::make()->schema([
                            Forms\Components\Checkbox::make('record_purchase')
                            ->label(trans('animal.resource.record_purchase')),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('purchased_from_id')
                            ->relationship('purchased_from', 'name')
                            ->searchable(),
                        Forms\Components\Select::make('breeder_id')
                            ->relationship('breeder', 'name')
                            ->searchable(),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(3),
                ]),

                
                Forms\Components\Section::make(trans('animal.resource.additional'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('contact_id')
                            ->relationship('contact', 'full_name')
                            ->searchable(),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Checkbox::make('on_feed')
                        ->label(trans('animal.resource.on_feed')),
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('feed')
                            ->label(trans('animal.resource.feed'))
                            ->placeholder(trans('animal.resource.purina')),
                    
                        Forms\Components\Select::make('harvest_unit')
                            ->label(trans('animal.resource.harvest_unit'))
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
                            ])->default("quantity")
                            ->hintIcon('heroicon-m-question-mark-circle', tooltip: trans('animal.resource.unit_hint'))
                    ])
                    ->columns(3),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('market_price')
                            ->numeric()
                            ->label(trans('animal.resource.market_price'))
                            ->prefix(trans('animal.resource.currency_symbol'))
                            ->postfix(trans('animal.resource.harvest unit')),
                    
                        Forms\Components\TextInput::make('estimated_value')
                            ->numeric()
                            ->label(trans('animal.resource.estimated_value'))
                            ->prefix(trans('animal.resource.currency_symbol')),
                    ])
                    ->columns(3),
                    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('animal.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(trans('animal.resource.gender'))
                    ->searchable()
                    ->sortable(),
               
                Tables\Columns\TextColumn::make('age')
                    ->label(trans('animal.resource.age'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_weight')
                    ->label(trans('animal.resource.last_weight'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(trans('animal.resource.status'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('animal.resource.type'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Active' => 'Active',
                        'Butchered' => 'Butchered',
                        'Culled' => 'Culled',
                        'Deceased' => 'Deceased',
                        'Dry' => 'Dry',
                        'Finishing' => 'Finishing',
                        'For Sale' => 'For Sale',
                        'Lactating' => 'Lactating',
                        'Lost' => 'Lost',
                        'Off Farm' => 'Off Farm',
                        'Quarantined' => 'Quarantined',
                        'Reference' => 'Reference',
                        'Sick' => 'Sick',
                        'Sold' => 'Sold',
                        'Weaning' => 'Weaning',
                        'Archived' => 'Archived'    
                    ])
                    ->multiple()
                    ->searchable(),
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
