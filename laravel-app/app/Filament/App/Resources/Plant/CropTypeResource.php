<?php

namespace App\Filament\App\Resources\Plant;

use App\Filament\App\Resources\Plant\CropTypeResource\Pages;
use App\Filament\App\Resources\Plant\CropTypeResource\RelationManagers;
use App\Models\Plant\CropType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CropTypeResource extends Resource
{
    protected static ?string $model = CropType::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Plantings';

    ////protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Crop Types';

    protected static ?int $navigationSort = 2;


    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.plantings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.crop_types');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.crop_types');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.crop_types'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('crop-type.resource.name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
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
                    ->label(trans('crop-type.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('crop-type.resource.name'))
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
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
            'index' => Pages\ListCropTypes::route('/'),
            'create' => Pages\CreateCropType::route('/create'),
            'edit' => Pages\EditCropType::route('/{record}/edit'),
        ];
    }    
}
