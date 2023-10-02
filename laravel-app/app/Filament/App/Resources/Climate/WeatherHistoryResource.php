<?php

namespace App\Filament\App\Resources\Climate;

use App\Filament\App\Resources\Climate\WeatherHistoryResource\Pages;
use App\Filament\App\Resources\Climate\WeatherHistoryResource\RelationManagers;
use App\Models\Climate\WeatherHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeatherHistoryResource extends Resource
{
    protected static ?string $model = WeatherHistory::class;

    
    protected static ?string $slug = 'climate/weather-history';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Climate';

    //protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $navigationLabel = 'Weather History';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.climate');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.weather_history');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.weather_history');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.weather_history'));
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
            'index' => Pages\ListWeatherHistories::route('/'),
            'create' => Pages\CreateWeatherHistory::route('/create'),
            'edit' => Pages\EditWeatherHistory::route('/{record}/edit'),
        ];
    }    
}
