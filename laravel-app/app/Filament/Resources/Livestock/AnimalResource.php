<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\AnimalResource\Pages;
use App\Filament\Resources\Livestock\AnimalResource\RelationManagers;
use App\Models\Livestock\Animal;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.livestock');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.animals');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Tabs::make(trans('animal.resource.detail'))
                ->tabs([
                    Tabs\Tab::make(trans('animal.resource.details'))
                        ->schema(self::getViewSchema()),
                    Tabs\Tab::make(trans('animal.resource.notes'))
                    ->schema([
                        

                    ]),
                    Tabs\Tab::make(trans('animal.resource.schedule'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.tasks'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.treatments'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.feedings'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.inputs'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.measurements'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.offspring'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.siblings'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.genealogy'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.yield'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.grazing'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.accounting'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.photos'))
                    ->schema([
                        // ...
                    ]),
                    Tabs\Tab::make(trans('animal.resource.files'))
                    ->schema([
                        // ...
                    ]),
                ])->columnSpanFull()
        ]);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(trans('animal.resource.basic'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('name')
                            ->inlineLabel()
                            ->label(trans('animal.resource.name'))
                            ->required()
                            ->live(onBlur: true),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('type')
                            ->inlineLabel()
                            ->label(trans('animal.resource.type'))
                            ->relationship('animal_type', 'name')
                            ->searchable(),
                    ])->columns(2),
                    
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('breed')
                            ->inlineLabel()
                            ->label(trans('animal.resource.breed'))
                            ->placeholder(trans('animal.resource.breed')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('gender')
                            ->inlineLabel()
                            ->label(trans('animal.resource.gender'))
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female'
                            ]),
                    ])->columns(2),
                    
                    Forms\Components\Group::make()->schema([
                        TagsInput::make('keywords')
                            ->inlineLabel()
                            ->label(trans('animal.resource.keywords'))
                            ->placeholder(trans('animal.resource.calf')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('internal_id')
                            ->inlineLabel()
                            ->label(trans('animal.resource.internal_id'))
                            ->placeholder(trans('animal.resource.example')),
                    ])->columns(2),
                    
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('status')
                            ->inlineLabel()
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
                            ])->reactive(),
                    ])->columns(2),
                    
                            
                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('death_date')
                            ->inlineLabel()
                            ->label(fn (Get $get) => trans("animal.resource.date_".strtolower($get('status'))))->columns(1),
                    ])
                    ->hidden(fn (Get $get) => !in_array($get('status'), ['Butchered', 'Culled', 'Deceased', 'Sold']))
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Textarea::make('deceased_reason')
                            ->inlineLabel()
                            ->label(trans("animal.resource.deceased_reason"))->columns(1),
                    ])
                    ->hidden(fn (Get $get) => $get('status') !== 'Deceased')
                    ->columns(2),
                    
                ]),

                Forms\Components\Section::make(trans('animal.resource.physical'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Checkbox::make('is_neutered')
                            ->inlineLabel()
                            ->inline()
                            ->label(trans('animal.resource.is_neutered')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Checkbox::make('breeding_stock')
                            ->inlineLabel()
                            ->label(trans('animal.resource.breeding_stock')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('coloring')
                            ->inlineLabel()
                            ->label(trans('animal.resource.coloring'))
                            ->placeholder(trans('animal.resource.brown')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('retention_score')
                            ->inlineLabel()
                            ->label(trans('animal.resource.retention_score')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Textarea::make('description')
                            ->inlineLabel()
                            ->label(trans('animal.resource.description'))
                    ])->columns(2)
                ]),

                Forms\Components\Section::make(trans('animal.resource.identification'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('tag_number')
                            ->inlineLabel()
                            ->label(trans('animal.resource.tag_number')),
                    
                        Forms\Components\TextInput::make('tag_color')
                            ->hiddenLabel()
                            ->placeholder(trans('animal.resource.tag_color')),
                    
                        Forms\Components\Select::make('tag_location')
                            ->hiddenLabel()
                            ->placeholder(trans('animal.resource.tag_location'))
                            ->options([
                                'Left Ear' => 'Left Ear',
                                'Right Ear' => 'Right Ear'
                            ]),
                    ])->columns(3),
                

                    Forms\Components\Group::make()->schema([
                            Forms\Components\TextInput::make('other_tag_number')
                                ->inlineLabel()
                                ->label(trans('animal.resource.other_tag_number')),

                            Forms\Components\TextInput::make('other_tag_color')
                            ->hiddenLabel()
                            ->placeholder(trans('animal.resource.other_tag_color')),

                            Forms\Components\Select::make('other_tag_location')
                            ->hiddenLabel()
                            ->placeholder(trans('animal.resource.other_tag_location'))
                                ->options([
                                    'Left Ear' => 'Left Ear',
                                    'Right Ear' => 'Right Ear'
                                ]),
                    ])->columns(3),
                

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('electronic_id')
                            ->inlineLabel()
                            ->label(trans('animal.resource.electronic_id')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('registry_number')
                            ->inlineLabel()
                            ->label(trans('animal.resource.registry_number')),
                    ])->columns(2),
                        
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('tattoo_left')
                            ->inlineLabel()
                            ->columns(1)
                            ->placeholder(trans('animal.resource.tattoo_left'))
                            ->label(trans('animal.resource.tattoos')),

                        Forms\Components\TextInput::make('tattoo_right')
                            ->hiddenLabel()
                            ->columns(1)
                            ->placeholder(trans('animal.resource.tattoo_right')),
                    ])->columns(2),
                ]),

                Forms\Components\Section::make(trans('animal.resource.birth'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('birth_date')
                            ->inlineLabel()
                            ->label(trans('animal.resource.birth_date'))->columns(1),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('mother')
                            ->relationship('animal_mother', 'name')
                            ->inlineLabel()
                            ->label(trans('animal.resource.mother'))
                            ->searchable(),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('father')
                            ->inlineLabel()
                            ->label(trans('animal.resource.father'))
                            ->relationship('animal_father', 'name')
                            ->searchable(),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('birth_weight')
                            ->postfix(trans('animal.resource.kg'))
                            ->numeric()
                            ->inlineLabel()
                            ->label(trans('animal.resource.birth_weight')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('days_to_wean')
                            ->postfix(trans('animal.resource.days'))
                            ->numeric()
                            ->inlineLabel()
                            ->label(trans('animal.resource.days_to_wean')),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('weaned_date')
                            ->inlineLabel()
                            ->label(trans('animal.resource.weaned_date'))->columns(1),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Radio::make('purchased')
                            ->inlineLabel()
                            ->label(trans('animal.resource.purchased'))
                            ->options([
                                'Raised' => 'Raised',
                                'Purchased' => 'Purchased'
                            ])
                            ->default('Raised')
                            ->reactive()
                            ->columns(1),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\DatePicker::make('purchase_date')
                            ->inlineLabel()
                            ->label(trans('animal.resource.purchase_date'))->columns(1),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('purchase_price')
                            ->inlineLabel()
                            ->label(trans('animal.resource.purchase_price'))
                            ->numeric()
                            ->columns(1),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(2),
                    
                    Forms\Components\Group::make()->schema([
                            Forms\Components\Checkbox::make('record_purchase')
                            ->inlineLabel()
                            ->inline()
                            ->label(trans('animal.resource.record_purchase')),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('purchased_from_id')
                            ->relationship('purchased_from', 'name')
                            ->searchable(),
                        Forms\Components\Select::make('breeder_id')
                            ->relationship('breeder', 'name')
                            ->searchable(),
                    ])
                    ->hidden(fn (Get $get) => $get('purchased') === 'Raised')
                    ->columns(2),
                ]),

                
                Forms\Components\Section::make(trans('animal.resource.additional'))
                ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('contact_id')
                        ->inlineLabel()
                        ->label(trans('animal.resource.contact_id'))
                            ->relationship('contact', 'full_name')
                            ->searchable(),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\Checkbox::make('on_feed')
                        ->inlineLabel()
                            ->label(trans('animal.resource.on_feed')),
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('feed')
                            ->inlineLabel()
                            ->label(trans('animal.resource.feed'))
                            ->placeholder(trans('animal.resource.purina')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('harvest_unit')
                            ->inlineLabel()
                            ->label(trans('animal.resource.harvest_unit'))
                            ->options([
                                "bales" => trans("common.resource.bales"),
                                "barrels" => trans("common.resource.barrels"),
                                "bunches" => trans("common.resource.bunches"),
                                "bushels" => trans("common.resource.bushels"),
                                "dozen" => trans("common.resource.dozen"),
                                "grams" => trans("common.resource.grams"),
                                "head" => trans("common.resource.head"),
                                "kilograms" => trans("common.resource.kilograms"),
                                "kiloliter" => trans("common.resource.kiloliter"),
                                "liter" => trans("common.resource.liter"),
                                "milliliter" => trans("common.resource.milliliter"),
                                "quantity" => trans("common.resource.quantity"),
                                "tonnes" => trans("common.resource.tonnes")
                            ])->default("quantity")
                            ->hintIcon('heroicon-m-question-mark-circle', tooltip: trans('animal.resource.unit_hint'))
                    ])
                    ->columns(2),

                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('market_price')
                            ->numeric()
                            ->inlineLabel()
                            ->label(trans('animal.resource.market_price'))
                            ->prefix(trans('animal.resource.currency_symbol'))
                            ->postfix(trans('animal.resource.harvest unit')),
                    ])->columns(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('estimated_value')
                            ->numeric()
                            ->inlineLabel()
                            ->label(trans('animal.resource.estimated_value'))
                            ->prefix(trans('animal.resource.currency_symbol')),
                    ])
                    ->columns(2),
                    
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
                Tables\Columns\TextColumn::make('animal_type.name')
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
                Tables\Actions\ViewAction::make(),
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
            //RelationManagers\NotesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
            'view' => Pages\ViewAnimal::route('/{record}'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }

    public static function getViewSchema(): array
    {
        return [
            Infolists\Components\Section::make(trans('animal.resource.basic'))
            ->schema([
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('name')
                        ->inlineLabel()
                        ->label(trans('animal.resource.name')),
                ])->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('animal_type.name')
                        ->inlineLabel()
                        ->label(trans('animal.resource.type')),
                ])->columns(2),
                
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('breed')
                        ->inlineLabel()
                        ->label(trans('animal.resource.breed')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('gender')
                        ->inlineLabel()
                        ->label(trans('animal.resource.gender')),
                ])->columns(2),
                
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('keywords')
                        ->inlineLabel()
                        ->label(trans('animal.resource.keywords'))
                        ->badge(),
                ])->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('internal_id')
                        ->inlineLabel()
                        ->label(trans('animal.resource.internal_id')),
                ])->columns(2),
                
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('status')
                        ->inlineLabel()
                        ->label(trans('animal.resource.status')),
                ])->columns(2),
                
                        
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('death_date')
                        ->inlineLabel()
                        ->date('d/m/Y'),
                ])
                ->hidden(fn (Model $model) => !in_array($model->status, ['Butchered', 'Culled', 'Deceased', 'Sold']))
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('deceased_reason')
                        ->inlineLabel()
                        ->label(trans("animal.resource.deceased_reason"))->columns(1),
                ])
                ->hidden(fn (Model $model) => $model->status !== 'Deceased')
                ->columns(2),
            ]),

            ///////////////////////////
            Infolists\Components\Section::make(trans('animal.resource.physical'))
            ->schema([
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('is_neutered')
                        ->inlineLabel()
                        ->label(trans('animal.resource.is_neutered')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('breeding_stock')
                        ->inlineLabel()
                        ->label(trans('animal.resource.breeding_stock')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('coloring')
                        ->inlineLabel()
                        ->label(trans('animal.resource.coloring'))
                        ->placeholder(trans('animal.resource.brown')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('retention_score')
                        ->inlineLabel()
                        ->label(trans('animal.resource.retention_score')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('description')
                        ->inlineLabel()
                        ->label(trans('animal.resource.description'))
                ])->columns(2)
            ]),

            Infolists\Components\Section::make(trans('animal.resource.identification'))
            ->schema([
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('tag_number')
                        ->inlineLabel()
                        ->label(trans('animal.resource.tag_number')),
                
                    Infolists\Components\TextEntry::make('tag_color')
                        ->hiddenLabel()
                        ,
                
                    Infolists\Components\TextEntry::make('tag_location')
                        ->hiddenLabel()
                        ,
                ])->columns(3),
            

                Infolists\Components\Group::make()->schema([
                        Infolists\Components\TextEntry::make('other_tag_number')
                            ->inlineLabel()
                            ->label(trans('animal.resource.other_tag_number')),

                        Infolists\Components\TextEntry::make('other_tag_color')
                        ->hiddenLabel(),

                        Infolists\Components\TextEntry::make('other_tag_location')
                        ->hiddenLabel(),
                ])->columns(3),
            

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('electronic_id')
                        ->inlineLabel()
                        ->label(trans('animal.resource.electronic_id')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('registry_number')
                        ->inlineLabel()
                        ->label(trans('animal.resource.registry_number')),
                ])->columns(2),
                    
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('tattoo_left')
                        ->inlineLabel()
                        ->columns(1)
                        ->label(trans('animal.resource.tattoos')),

                    Infolists\Components\TextEntry::make('tattoo_right')
                        ->hiddenLabel()
                        ->columns(1),
                ])->columns(2),
            ]),

            Infolists\Components\Section::make(trans('animal.resource.birth'))
            ->schema([
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('birth_date')
                        ->inlineLabel()
                        ->date('d/m/Y')
                        ->label(trans('animal.resource.birth_date'))->columns(1),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('animal_mother.name')
                        ->inlineLabel()
                        ->label(trans('animal.resource.mother')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('animal_father.name')
                        ->inlineLabel()
                        ->label(trans('animal.resource.father')),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('birth_weight')
                        ->numeric()
                        ->inlineLabel()
                        ->label(trans('animal.resource.birth_weight')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('days_to_wean')
                        ->numeric()
                        ->inlineLabel()
                        ->label(trans('animal.resource.days_to_wean')),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('weaned_date')
                        ->inlineLabel()
                        ->date('d/m/Y')
                        ->label(trans('animal.resource.weaned_date'))->columns(1),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('purchased')
                        ->inlineLabel()
                        ->label(trans('animal.resource.purchased'))
                        ->columns(1),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('purchase_date')
                        ->inlineLabel()
                        ->date('d/m/Y')
                        ->label(trans('animal.resource.purchase_date'))->columns(1),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('purchase_price')
                        ->inlineLabel()
                        ->label(trans('animal.resource.purchase_price'))
                        ->numeric()
                        ->columns(1),
                ])
                ->hidden(fn (Model $model) => $model->purchased === 'Raised')
                ->columns(2),
                
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('record_purchase')
                    ->inlineLabel()
                    ->label(trans('animal.resource.record_purchase')),
                ])
                ->hidden(fn (Model $model) => $model->purchased === 'Raised')
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('purchased_from.name')
                    ->inlineLabel()
                    ->label(trans('animal.resource.purchased_from')),

                    Infolists\Components\TextEntry::make('breeder.name')
                    ->inlineLabel()
                    ->label(trans('animal.resource.breeder')),
                ])
                ->hidden(fn (Model $model) => $model->purchased === 'Raised')
                ->columns(2),
            ]),

            
            Infolists\Components\Section::make(trans('animal.resource.additional'))
            ->schema([
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('contact.name')
                    ->inlineLabel()
                    ->label(trans('animal.resource.contact_id')),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('on_feed')
                    ->inlineLabel()
                    ->label(trans('animal.resource.on_feed')),
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('feed')
                        ->inlineLabel()
                        ->label(trans('animal.resource.feed')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('harvest_unit')
                        ->inlineLabel()
                        ->label(trans('animal.resource.harvest_unit'))
                ])
                ->columns(2),

                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('market_price')
                        ->numeric()
                        ->money()
                        ->inlineLabel()
                        ->label(trans('animal.resource.market_price')),
                ])->columns(2),
                Infolists\Components\Group::make()->schema([
                    Infolists\Components\TextEntry::make('estimated_value')
                        ->numeric()
                        ->inlineLabel()
                        ->label(trans('animal.resource.estimated_value')),
                ])
                ->columns(2),
                
            ])

        ];
    }
}
