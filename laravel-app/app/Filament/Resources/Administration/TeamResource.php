<?php

namespace App\Filament\Resources\Administration;

use App\Filament\Resources\Administration\TeamResource\Pages;
use App\Filament\Resources\Administration\TeamResource\RelationManagers;
use App\Forms\Components\AddressForm;
use App\Models\Administration\Team;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $slug = 'administration/teams';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 3;

    protected static ?int $navigationGroupSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.administration');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.teams');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.teams');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.teams'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('team.resource.name'))
                    ->required()
                    ->live(onBlur: true),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('contact_name')
                        ->label(trans('team.resource.contact_name'))
                        ->required()
                        ->maxValue(50)
                        ->live(onBlur: true),
                    Forms\Components\TextInput::make('contact_phone')
                        ->label(trans('team.resource.contact_phone'))
                        ->maxValue(50),
                    Forms\Components\TextInput::make('contact_email')
                        ->label(trans('team.resource.contact_email'))
                        ->email()
                        //->unique(ignoreRecord: true)
                        ->required(),
                ]),
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
                    ->label(trans('common.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('team.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->label(trans('team.resource.contact_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label(trans('team.resource.contact_email'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label(trans('team.resource.contact_phone'))
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }    
}
