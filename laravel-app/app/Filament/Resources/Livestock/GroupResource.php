<?php

namespace App\Filament\Resources\Livestock;

use App\Filament\Resources\Livestock\GroupResource\Pages;
use App\Filament\Resources\Livestock\GroupResource\RelationManagers;
use App\Models\Livestock\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $slug = 'livestock/groups';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Livestock';

    ////protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Livestock Groups';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.livestock');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.livestock_groups');
    }
    
    public static function getPluralModelLabel(): string
    {
        return __('common.resource.livestock_groups');
    }
    
    public static function getModelLabel(): string
    {
        return strtolower(__('common.resource.livestock_groups'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(trans('group.resource.name'))
                    ->required()
                    //->maxValue(50)
                    ->live(onBlur: true),
                Forms\Components\Textarea::make('description')
                    ->label(trans('group.resource.description'))
                    ->columnSpan('full'),
                Forms\Components\Checkbox::make('active_only')
                    ->label(trans('group.resource.active_only'))
                    ->columnSpan('full'),
                Forms\Components\Radio::make('type')
                    ->hiddenLabel()
                    ->options([
                        'Smart' => 'Smart Group - Automaticlly assign animals',
                        'Basic' => 'Basic Group - Manually assign animals',
                        'Set' => 'Set - Track records for multiple animals, like a flock together'
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(trans('contact.resource.id'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('group.resource.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(trans('group.resource.type'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'Smart' => 'Smart Group - Automaticlly assign animals',
                        'Basic' => 'Basic Group - Manually assign animals',
                        'Set' => 'Set - Track records for multiple animals, like a flock together'
                    ])
                    ->multiple()
                    ->searchable(),

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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }    
}
