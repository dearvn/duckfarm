<?php

namespace App\Filament\Resources\Market;

use App\Filament\Resources\Market\LocationResource\Pages;
use App\Filament\Resources\Market\LocationResource\RelationManagers;
use App\Models\Market\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $slug = 'market/locations';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Market';

    //protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Locations';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.market');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.locations');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.locations');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.locations'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }    
}
