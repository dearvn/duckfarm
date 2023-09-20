<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\AnimalTypeResource\Pages;
use App\Filament\Resources\Livestock\AnimalTypeResource\RelationManagers;
use App\Models\Livestock\AnimalType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalTypeResource extends Resource
{
    protected static ?string $model = AnimalType::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Livestock';

    ////protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Animal Types';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('animal-type.resource.name'))
                    ->required()
                    ->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\MarkdownEditor::make('description')
                    ->label(trans('animal-type.resource.description'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('animal-type.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('animal-type.resource.name'))
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
            'index' => Pages\ListAnimalTypes::route('/'),
            'create' => Pages\CreateAnimalType::route('/create'),
            'edit' => Pages\EditAnimalType::route('/{record}/edit'),
        ];
    }    
}
