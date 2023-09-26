<?php

namespace App\Filament\Resources\Plant;

use App\Filament\Resources\Plant\LocationResource\Pages;
use App\Filament\Resources\Plant\LocationResource\RelationManagers;
use App\Models\Plant\Location;
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

    protected static ?string $slug = 'planting/locations';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Plantings';

    //protected static ?string $navigationIcon = 'heroicon-m-building-office-2';

    protected static ?string $navigationLabel = 'Grow Locations';

    protected static ?int $navigationSort = 4;
    
    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.plantings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.grow_locations');
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
