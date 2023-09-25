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
                                    ->label(trans('animal-note.resource.description'))
                                    ->rows(6)
                                    ->columnSpan('full'),

                                SpatieMediaLibraryFileUpload::make('attachments')
                                    ->label(trans('animal-note.resource.attachments'))
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
                        Forms\Components\DatePicker::make('due_date')
                            ->label(trans('animal-note.resource.date'))
                            ->default(now()),

                        Forms\Components\Select::make('category')
                            ->label(trans('animal-note.resource.category'))
                            ->options([
                                'Breeding' => trans('animal-note.resource.breeding'),
                                'Deworming' => trans('animal-note.resource.deworming'),
                                'General' => trans('animal-note.resource.general'),
                                'Grazing' => trans('animal-note.resource.grazing'),
                                'Grooming' => trans('animal-note.resource.grooming'),
                                'Injury' => trans('animal-note.resource.injury'),
                                'Medication' => trans('animal-note.resource.medication'),
                                'Moved' => trans('animal-note.resource.moved'),
                                'Pregnancy Check' => trans('animal-note.resource.pregnancy_check'),
                                'Supplement' => trans('animal-note.resource.supplement'),
                                'Vaccination' => trans('animal-note.resource.vaccination'),
                                'Other' => trans('animal-note.resource.other')
                            ]),
                        
                        TagsInput::make('keywords')
                            ->label(trans('animal-note.resource.keywords')),
                        Forms\Components\Select::make('assigned_to')
                            //->relationship('user', 'name')
                            ->label(trans('animal-note.resource.assigned_to'))
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
                Tables\Columns\TextColumn::make('date')->date('d/m/Y'),
                Tables\Columns\TextColumn::make('description'),
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
