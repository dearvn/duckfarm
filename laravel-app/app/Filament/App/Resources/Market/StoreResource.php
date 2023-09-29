<?php

namespace App\Filament\App\Resources\Market;

use App\Filament\App\Resources\Market\StoreResource\Pages;
use App\Filament\App\Resources\Market\StoreResource\RelationManagers;
use App\Models\Market\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $slug = 'market/stores';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Market';

    //protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Stores';

    protected static ?int $navigationSort = 2;
    

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.market');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.stores');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.resource.stores');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.stores'));
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }    
}
