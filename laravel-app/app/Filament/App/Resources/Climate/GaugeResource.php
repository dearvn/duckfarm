<?php

namespace App\Filament\App\Resources\Climate;

use App\Filament\App\Resources\Climate\GaugeResource\Pages;
use App\Filament\App\Resources\Climate\GaugeResource\RelationManagers;
use App\Models\Climate\Gauge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaugeResource extends Resource
{
    protected static ?string $model = Gauge::class;

    
    protected static ?string $slug = 'climate/guages';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Climate';

    //protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?string $navigationLabel = 'Guages';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.climate');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.guages');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.guages');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.guages'));
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
            'index' => Pages\ListGauges::route('/'),
            'create' => Pages\CreateGauge::route('/create'),
            'edit' => Pages\EditGauge::route('/{record}/edit'),
        ];
    }    
}
