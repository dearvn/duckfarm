<?php

namespace App\Filament\Pages\Setting;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class ImageParam extends SettingsPage
{
    #protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $slug = 'setting/image';

    protected static ?string $navigationGroup = 'Settings';

    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.image_param');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('copyright')
                ->label('Copyright notice')
                ->required(),
            Repeater::make('links')
                ->schema([
                    TextInput::make('label')->required(),
                    TextInput::make('url')
                        ->url()
                        ->required(),
                ]),
            ]);
    }
}
