<?php

namespace App\Filament\Resources\Tool;

use App\Filament\Resources\Tool\EquipmentResource\Pages;
use App\Filament\Resources\Tool\EquipmentResource\RelationManagers;
use App\Models\Tool\Equipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $slug = 'resource/equipment';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Resources';

    //protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static ?string $navigationLabel = 'Equipment';

    protected static ?int $navigationSort = 1;


    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.resources');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.equipment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.equipment');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.equipment'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('equipment.resource.name'))
                    ->required()
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('type')
                    ->label(trans('equipment.resource.type'))
                    ->placeholder(trans('equipment.resource.tractor')),
                Forms\Components\Select::make('status')
                    ->label(trans('equipment.resource.status'))
                    ->options([
                        'At Dealer' => 'At Dealer',
                        'Decommissioned' => 'Decommissioned',
                        'Do Not Start' => 'Do Not Start',
                        'Do Not Use' => 'Do Not Use',
                        'In Use' => 'In Use',
                        'Loaned Out' => 'Loaned Out',
                        'Maintenance' => 'Maintenance',
                        'Out of Service' => 'Out of Service',
                        'Pending Validation' => 'Pending Validation',
                        'Repair' => 'Repair',
                        'Sold' => 'Sold',
                        'Tagged Out' => 'Tagged Out',
                        'Under Review' => 'Under Review'
                    ]),
                Forms\Components\TextInput::make('brand')
                    ->label(trans('equipment.resource.brand'))
                    ->placeholder(trans('equipment.resource.kubato')),
                Forms\Components\TextInput::make('model_number')
                    ->label(trans('equipment.resource.model_number'))
                    ->placeholder(trans('equipment.resource.model')),
                    
                Forms\Components\TextInput::make('year')
                    ->label(trans('equipment.resource.year'))
                    ->numeric()
                    ->minValue(1900),
               
                Forms\Components\TextInput::make('plate_number')
                    ->label(trans('equipment.resource.plate_number')),
               

                Forms\Components\TextInput::make('serial_number')
                    ->label(trans('equipment.resource.serial_number')),
               

                Forms\Components\TextInput::make('engine')
                    ->label(trans('equipment.resource.engine'))
                    ->placeholder(trans('equipment.resource.diesel')),
               

                Forms\Components\TextInput::make('transmission')
                    ->label(trans('equipment.resource.transmission'))
                    ->placeholder(trans('equipment.resource.collar')),

                
                Forms\Components\Select::make('usage_unit')
                    ->label(trans('equipment.resource.usage_unit'))
                    ->options([
                        'Hours' => 'Hours',
                        'Miles' => 'Miles',
                        'Kilometers' => 'Kilometers'
                    ]),
                Forms\Components\TextInput::make('manual_url')
                    ->label(trans('equipment.resource.manual_url'))
                    ->url()
                    ->placeholder(trans('equipment.resource.url')),
               
                Forms\Components\Radio::make('purchased')
                    ->label(trans('equipment.resource.purchased'))
                    ->options([
                        'Leased' => 'Leased',
                        'Purchased' => 'Purchased'
                    ]),
                
                Forms\Components\DatePicker::make('date_purchased')
                ->label(trans('equipment.resource.date_purchased'))
                    ->placeholder('dd/mm/yyyy'),

                Forms\Components\TextInput::make('amount')
                    ->label(trans('equipment.resource.amount'))
                    ->numeric()
                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/']),

                Forms\Components\Checkbox::make('insured')
                    ->label(trans('equipment.resource.insured')),

                Forms\Components\Textarea::make('description')
                    ->label(trans('equipment.resource.description'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('equipment.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('equipment.resource.type'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand')
                    ->label(trans('equipment.resource.brand'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model_number')
                    ->label(trans('equipment.resource.model_number'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(trans('equipment.resource.status'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'At Dealer' => 'At Dealer',
                        'Decommissioned' => 'Decommissioned',
                        'Do Not Start' => 'Do Not Start',
                        'Do Not Use' => 'Do Not Use',
                        'In Use' => 'In Use',
                        'Loaned Out' => 'Loaned Out',
                        'Maintenance' => 'Maintenance',
                        'Out of Service' => 'Out of Service',
                        'Pending Validation' => 'Pending Validation',
                        'Repair' => 'Repair',
                        'Sold' => 'Sold',
                        'Tagged Out' => 'Tagged Out',
                        'Under Review' => 'Under Review'
                    ]),
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
            'index' => Pages\ListEquipments::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
