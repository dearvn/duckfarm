<?php

namespace App\Filament\App\Resources\Plant;

use App\Filament\App\Resources\Plant\CropResource\Pages;
use App\Filament\App\Resources\Plant\CropResource\RelationManagers;
use App\Models\Plant\Crop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CropResource extends Resource
{
    protected static ?string $model = Crop::class;

    protected static ?string $slug = 'plants';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Plantings';

    //protected static ?string $navigationIcon = 'heroicon-m-view-columns';

    protected static ?string $navigationLabel = 'Crops';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.plantings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.crops');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.crops');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.crops'));
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
            'index' => Pages\ListCrops::route('/'),
            'create' => Pages\CreateCrop::route('/create'),
            'edit' => Pages\EditCrop::route('/{record}/edit'),
        ];
    }    
}
