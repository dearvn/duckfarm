<?php

namespace App\Filament\App\Resources\Report;

use App\Filament\App\Resources\Report\CustomReportResource\Pages;
use App\Filament\App\Resources\Report\CustomReportResource\RelationManagers;
use App\Models\Report\CustomReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomReportResource extends Resource
{
    protected static ?string $model = CustomReport::class;

    protected static ?string $slug = 'report/custom';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Reports';

    //protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static ?string $navigationLabel = 'Custom Reports';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.reports');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.custom_reports');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.custom_reports');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.custom_reports'));
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
            'index' => Pages\ListCustomReports::route('/'),
            'create' => Pages\CreateCustomReport::route('/create'),
            'edit' => Pages\EditCustomReport::route('/{record}/edit'),
        ];
    }    
}
