<?php

namespace App\Filament\Resources\Plant;

use App\Filament\Resources\Plant\PlanResource\Pages;
use App\Filament\Resources\Plant\PlanResource\RelationManagers;
use App\Models\Plant\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $slug = 'planting/plans';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Plantings';

    //protected static ?string $navigationIcon = 'heroicon-s-gift-top';

    protected static ?string $navigationLabel = 'Crop Plan';

    protected static ?int $navigationSort = 3;


    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.plantings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.crop_plan');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.crop_plan');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.crop_plan'));
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }    
}
