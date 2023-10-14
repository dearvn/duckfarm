<?php

namespace App\Filament\Pages\Tenancy;

use App\Forms\Components\AddressForm;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Database\Eloquent\Model;
 
class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return trans('team.resource.heading');
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label(trans('team.resource.name'))
                ->required(),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('contact_name')
                        ->label(trans('team.resource.contact_name'))
                        ->required()
                        ->maxValue(50)
                        ->live(onBlur: true),
                    Forms\Components\TextInput::make('contact_phone')
                        ->label(trans('team.resource.contact_phone'))
                        ->maxValue(50),
                    Forms\Components\TextInput::make('contact_email')
                        ->label(trans('team.resource.contact_email'))
                        ->email()
                        //->unique(ignoreRecord: true)
                        ->required(),
                ]),
                AddressForm::make('address')
                ->columnSpan('full'),

                Forms\Components\Textarea::make('description')
                ->label(trans('common.resource.description'))
                ->columnSpan('full'),
            ]);
    }
}