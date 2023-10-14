<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use App\Filament\App\Resources\UserResource\Pages;
use App\Filament\App\Resources\UserResource\RelationManagers;
use SolutionForest\FilamentAccessManagement\Support\Utils;

class UserResource extends Resource
{

    protected static ?string $slug = 'administration/users';

    protected static ?int $navigationSort = 1;

    protected static ?int $navigationGroupSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.administration');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.users');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.users');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.users'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(trans('user.resource.name'))
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(table: static::getModel(), ignorable: fn ($record) => $record)
                            ->label(trans('user.resource.email')),

                        Forms\Components\TextInput::make('password')
                            ->same('passwordConfirmation')
                            ->password()
                            ->maxLength(255)
                            ->required(fn ($component, $get, $livewire, $model, $record, $set, $state) => $record === null)
                            ->dehydrateStateUsing(fn ($state) => ! empty($state) ? Hash::make($state) : '')
                            ->label(trans('user.resource.password')),

                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->password()
                            ->dehydrated(false)
                            ->maxLength(255)
                            ->label(trans('user.resource.confirm_password')),

                        Forms\Components\Select::make('roles')
                             ->multiple()
                             ->relationship('roles', 'name')
                             ->preload()
                             ->label(trans('user.resource.roles')),

                        
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label(trans('common.resource.id')),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(trans('user.resource.name')),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(trans('user.resource.email')),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->icons([
                        'heroicon-o-check-circle',
                        'heroicon-o-x-circle' => fn ($state): bool => $state === null,
                    ])
                    ->dateTime('d/m/Y H:i:s')
                    ->colors([
                        'success',
                        'danger' => fn ($state): bool => $state === null,
                    ])
                    ->label(trans('user.resource.verified_at')),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label(trans('user.resource.roles')),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->label(trans('common.resource.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

}
