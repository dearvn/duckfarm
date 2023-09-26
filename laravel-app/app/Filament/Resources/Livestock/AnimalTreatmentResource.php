<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\AnimalTreatmentResource\Pages;
use App\Filament\Resources\Livestock\AnimalTreatmentResource\RelationManagers;
use App\Models\Livestock\AnimalTreatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalTreatmentResource extends Resource
{
    protected static ?string $model = AnimalTreatment::class;

    //protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

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
            'index' => Pages\ListAnimalTreatments::route('/'),
            'create' => Pages\CreateAnimalTreatment::route('/create'),
            'edit' => Pages\EditAnimalTreatment::route('/{record}/edit'),
        ];
    }    
}
