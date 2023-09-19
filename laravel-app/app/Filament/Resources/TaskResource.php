<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Task';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->columnSpan('full')
                                    ->live(onBlur: true),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpan('full'),

                                SpatieMediaLibraryFileUpload::make('attachments')
                                    ->collection('task-documents')
                                    ->multiple()
                                    ->columnSpan('full')
                                    ->maxFiles(5)
                                    ->enableReordering(),

                                Forms\Components\Select::make('associated_to')
                                    ->relationship('animal', 'name')
                                    ->columnSpan('full')
                                    ->searchable()
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'To Do' => 'To Do',
                                'In Progress' => 'In Progress',
                                'Done' => 'Done',
                                'Incomplete' => 'Incomplete',
                                'Missed' => 'Missed',
                                'Skipped' => 'Skipped'
                            ])
                            ->default('To Do'),
                        
                        Forms\Components\Select::make('assigned_to')
                            //->relationship('user', 'name')
                            ->options(User::all()->pluck('name', 'id'))
                            ->columnSpan('full')
                            ->searchable(),

                        Forms\Components\DatePicker::make('due_date')
                            ->label('Due Date')
                            ->default(now()),

                        Forms\Components\Select::make('repeats')
                            ->options([
                                'Does not repeat' => 'Does not repeat',
                                'Daily' => 'Daily',
                                'Weekly' => 'Weekly',
                                'Monthly' => 'Monthly',
                                'Yearly' => 'Yearly'
                            ])
                            ->default('Does not repeat'),

                        Forms\Components\TextInput::make('hours_spent')
                            ->label('Hours Spent')
                            ->numeric()
                            ->step(0.1)
                            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                            ->required(),

                        /*Forms\Components\Section::make('Associations')
                            ->schema([
                                Forms\Components\Select::make('shop_brand_id')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->hiddenOn(ProductsRelationManager::class),

                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->required(),
                            ]),*/
                    ])
                    ->columnSpan(['lg' => 1]),
                
                
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTasks::route('/'),
        ];
    }    
}
