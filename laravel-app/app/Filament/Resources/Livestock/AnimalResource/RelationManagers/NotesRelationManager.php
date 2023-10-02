<?php

namespace App\Filament\Resources\Livestock\AnimalResource\RelationManagers;

use App\Models\User;
use BladeUI\Icons\Components\Icon;
use Closure;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class NotesRelationManager extends RelationManager
{
    protected static string $relationship = 'animal_notes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Textarea::make('description')
                                    ->label(trans('common.resource.description'))
                                    ->rows(6)
                                    ->columnSpan('full'),

                                SpatieMediaLibraryFileUpload::make('attachments')
                                    ->label(trans('animal-notes.resource.attachments'))
                                    ->collection('task-documents')
                                    ->multiple()
                                    ->columnSpan('full')
                                    ->maxFiles(5)
                                    ->reorderable(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label(trans('animal-notes.resource.date'))
                            ->default(now()),

                        Forms\Components\Select::make('category')
                            ->label(trans('animal-notes.resource.category'))
                            ->options([
                                'Breeding' => trans('animal-notes.resource.breeding'),
                                'Deworming' => trans('animal-notes.resource.deworming'),
                                'General' => trans('animal-notes.resource.general'),
                                'Grazing' => trans('animal-notes.resource.grazing'),
                                'Grooming' => trans('animal-notes.resource.grooming'),
                                'Injury' => trans('animal-notes.resource.injury'),
                                'Medication' => trans('animal-notes.resource.medication'),
                                'Moved' => trans('animal-notes.resource.moved'),
                                'Pregnancy Check' => trans('animal-notes.resource.pregnancy_check'),
                                'Supplement' => trans('animal-notes.resource.supplement'),
                                'Vaccination' => trans('animal-notes.resource.vaccination'),
                                'Other' => trans('animal-notes.resource.other')
                            ]),
                        
                        TagsInput::make('keywords')
                            ->label(trans('animal-notes.resource.keywords')),
                        Forms\Components\Select::make('assigned_to')
                            //->relationship('user', 'name')
                            ->label(trans('animal-notes.resource.assigned_to'))
                            ->options(User::all()->pluck('name', 'id'))
                            ->columnSpan('full')
                            ->searchable(),
                    ])
                    ->columnSpan(['lg' => 1]),
                
                
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                ->date('d/m/Y')
                ->label(trans('animal-note.resource.date'))
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('description')
                ->label(trans('common.resource.description')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
