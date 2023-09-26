<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Filament\Resources\TaskResource\Widgets\TaskStats;
use App\Models\Task;
use App\Models\User;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Task';

    protected static ?int $navigationSort = 2;

     /*public static function getNavigationGroup(): ?string
    {
        return __('common.resource.reports');
    }*/

    public static function getNavigationLabel(): string
    {
        return __('common.resource.task');
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(trans('task.resource.name'))
                                    ->required()
                                    ->columnSpan('full')
                                    ->live(onBlur: true),

                                Forms\Components\Textarea::make('description')
                                    ->label(trans('task.resource.description'))
                                    ->columnSpan('full'),

                                Forms\Components\Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Checkbox::make('is_enable')
                                            ->hiddenLabel()
                                            ->columnSpan([
                                                'md' => 2,
                                            ])
                                            ->required(),
                
                                        Forms\Components\TextInput::make('name')
                                            ->placeholder(trans('task.resource.item_name'))
                                            ->hiddenLabel()
                                            //->disabled()
                                            ->dehydrated()
                                            //->numeric()
                                            ->required()
                                            ->columnSpan([
                                                'md' => 3,
                                            ]),

                                        Forms\Components\Select::make('assigned_to')
                                            ->placeholder(trans('task.resource.assigned_to'))
                                            ->hiddenLabel()
                                            ->options(User::query()->pluck('name', 'id'))
                                            ->required()
                                            ->reactive()
                                            ->columnSpan([
                                                'md' => 5,
                                            ])
                                            ->searchable(),
                                    ])
                                    //->orderable()
                                    ->defaultItems(1)
                                    //->disableLabel()
                                    ->columns([
                                        'md' => 12,
                                    ])
                                    ->columnSpan('full'),

                                SpatieMediaLibraryFileUpload::make('attachments')
                                    ->label(trans('task.resource.attachments'))
                                    ->collection('task-documents')
                                    ->multiple()
                                    ->columnSpan('full')
                                    ->maxFiles(5)
                                    ->reorderable(),

                                /*Forms\Components\Select::make('associated_to')
                                    ->relationship('animal', 'name')
                                    ->columnSpan('full'),*/

                                Forms\Components\ColorPicker::make('task_color')
                                    ->label(trans('task.resource.task_color'))
                                    ->columnSpan('full')
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

                        Forms\Components\Select::make('priority')
                            ->options([
                                '5' => 'Highest',
                                '4' => 'High',
                                '3' => 'Medium',
                                '2' => 'Low',
                                '1' => 'Lowest'
                            ])
                            ->default('Does not repeat'),

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
                            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/']),

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
                    ->label(trans('task.resource.task'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('animal.name')
                    ->label(trans('task.resource.associated_to'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->label(trans('task.resource.due_date'))
                    ->dateTime('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('priority')
                    ->label(trans('task.resource.priority'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label(trans('task.resource.status'))
                    ->options([
                        'To Do' => 'To Do',
                        'In Progress' => 'In Progress',
                        'Done' => 'Done',
                        'Incomplete' => 'Incomplete',
                        'Missed' => 'Missed',
                        'Skipped' => 'Skipped'
                    ])
                    /*->colors([
                        'info' => 'To Do',
                        'success' => 'Done',
                        'warning' => 'In Progress',
                        'danger' => fn ($state) => in_array($state, ['Incomplete', 'Missed', 'Skipped']),
                    ])*/,
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label(trans('task.resource.assigned_to'))
                    ->searchable()
                    ->sortable(),    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d/m/Y H:i')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(trans('task.resource.created_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['To Do' => 'To Do',
                    'In Progress' => 'In Progress',
                    'Done' => 'Done',
                    'Incomplete' => 'Incomplete',
                    'Missed' => 'Missed',
                    'Skipped' => 'Skipped'])
                    ->multiple()
                    ->searchable(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->format('d/m/Y')
                            ->placeholder(fn ($state): string => date('d/m/Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->format('d/m/Y')
                            ->placeholder(fn ($state): string => now()->format('d/m/Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Task from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Task until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Action::make('complete')
                        ->label('Done')
                        ->action(fn (Model $record) => self::completeTask($record))
                        ->icon('heroicon-m-paper-airplane')
                        ->outlined()
                        ->color('success')
                        ->hidden(fn (Model $record): bool => $record->status == 'Done')
                ])
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function () {
                        Notification::make()
                            ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                            ->warning()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    private static function completeTask($model): void
    {
        $model->update(['status' => 'Done']);
    }

    public static function getWidgets(): array
    {
        return [
            TaskStats::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        /** @var Task $record */

        return [
            'Task' => optional($record)->name,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['animal']);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
