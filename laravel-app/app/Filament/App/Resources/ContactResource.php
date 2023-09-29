<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ContactResource\Pages;
use App\Filament\App\Resources\ContactResource\RelationManagers;
use App\Filament\App\Resources\ContactResource\Widgets\ContactStats;
use App\Forms\Components\AddressForm;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Squire\Models\Country;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $tenantRelationshipName = 'contacts';

    protected static ?string $recordTitleAttribute = 'last_name';

    protected static ?string $navigationLabel = 'Contact';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?int $navigationSort = 10;
    
    /*public static function getNavigationGroup(): ?string
    {
        return __('common.resource.reports');
    }*/

    public static function getNavigationLabel(): string
    {
        return __('common.resource.contact');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.contact');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.contact'));
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label(trans('contact.resource.first_name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('last_name')
                    ->label(trans('contact.resource.last_name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\TextInput::make('email')
                    ->label(trans('contact.resource.email'))
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('primary_phone')
                    ->label(trans('contact.resource.primary_phone'))
                    ->maxValue(50),
                Forms\Components\TextInput::make('mobile_phone')
                    ->label(trans('contact.resource.mobile_phone'))
                    ->maxValue(50),
                Forms\Components\TextInput::make('fax')
                    ->label(trans('contact.resource.fax'))
                    ->maxValue(50),
                Forms\Components\Select::make('contact_type')
                    ->options([
                        'Auditor' => 'Auditor',
                        'Breeder' => 'Breeder',
                        'Buyer' => 'Buyer',
                        'Certifier' => 'Certifier',
                        'Contact' => 'Contact',
                        'Consultant' => 'Consultant',
                        'Contractor' => 'Contractor',
                        'Customer' => 'Customer',
                        'Employee' => 'Employee',
                        'Purchaser' => 'Purchaser',
                        'Supplier' => 'Supplier',
                        'Vendor' => 'Vendor',
                        'Veterinarian' => 'Veterinarian',
                        'Wholesale Customer' => 'Wholesale Customer'
                    ])
                    ->default('To Do'),
                Forms\Components\TextInput::make('company')
                ->label(trans('contact.resource.company')),

                TagsInput::make('keywords'),

                AddressForm::make('address')
                ->columnSpan('full'),

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
                    ->label(trans('contact.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label(trans('contact.resource.first_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(trans('contact.resource.last_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(trans('contact.resource.email'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('primary_phone')
                    ->label(trans('contact.resource.primary_phone'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_type')
                    ->label(trans('contact.resource.contact_type'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('contact_type')
                    ->options([
                        'Auditor' => 'Auditor',
                        'Breeder' => 'Breeder',
                        'Buyer' => 'Buyer',
                        'Certifier' => 'Certifier',
                        'Contact' => 'Contact',
                        'Consultant' => 'Consultant',
                        'Contractor' => 'Contractor',
                        'Customer' => 'Customer',
                        'Employee' => 'Employee',
                        'Purchaser' => 'Purchaser',
                        'Supplier' => 'Supplier',
                        'Vendor' => 'Vendor',
                        'Veterinarian' => 'Veterinarian',
                        'Wholesale Customer' => 'Wholesale Customer'
                    ])
                    ->multiple()
                    ->searchable(),
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
    public static function testAction($item) {
        echo "aaaa";
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getWidgets(): array
    {
        return [
            ContactStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
