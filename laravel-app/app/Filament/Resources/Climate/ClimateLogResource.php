<?php

namespace App\Filament\Resources\Climate;

use App\Filament\Resources\Climate\ClimateLogResource\Pages;
use App\Filament\Resources\Climate\ClimateLogResource\RelationManagers;
use App\Models\Climate\ClimateLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClimateLogResource extends Resource
{
    protected static ?string $model = ClimateLog::class;

    protected static ?string $slug = 'climate/logs';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Climate';

    protected static ?string $navigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationLabel = 'Climate Logs';

    protected static ?int $navigationSort = 2;
    
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
            'index' => Pages\ListClimateLogs::route('/'),
            'create' => Pages\CreateClimateLog::route('/create'),
            'edit' => Pages\EditClimateLog::route('/{record}/edit'),
        ];
    }    
}
