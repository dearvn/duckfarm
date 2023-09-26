<?php

namespace App\Filament\Resources\Report;

use App\Filament\Resources\Report\StandardReportResource\Pages;
use App\Filament\Resources\Report\StandardReportResource\RelationManagers;
use App\Models\Report\StandardReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StandardReportResource extends Resource
{
    protected static ?string $model = StandardReport::class;

    protected static ?string $slug = 'report/standard';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Reports';

    //protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';

    protected static ?string $navigationLabel = 'Standard Reports';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.reports');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.standard_reports');
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
            'index' => Pages\ListStandardReports::route('/'),
            'create' => Pages\CreateStandardReport::route('/create'),
            'edit' => Pages\EditStandardReport::route('/{record}/edit'),
        ];
    }    
}
