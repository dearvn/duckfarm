<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\AnimalResource\Pages;
use App\Filament\Resources\Livestock\AnimalResource\RelationManagers;
use App\Models\Livestock\Animal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $slug = 'livestock/animals';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Livestock';

    ////protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Animals';

    protected static ?int $navigationSort = 1;

    protected static ?int $navigationGroupSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(trans('animal.resource.name'))
                        ->required()
                        ->live(onBlur: true),
                    Forms\Components\Select::make('type')
                        ->relationship('animal_type', 'name')
                        ->searchable(),
                    Forms\Components\TextInput::make('breed')
                        ->label(trans('animal.resource.breed')),


                    Forms\Components\MarkdownEditor::make('description')
                        ->label(trans('animal.resource.description'))
                        ->columnSpan('full'),

                    
                ])
                ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
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
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }    

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
