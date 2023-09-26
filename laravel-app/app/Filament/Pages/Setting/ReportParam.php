<?php

namespace App\Filament\Pages\Setting;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;

class ReportParam extends SettingsPage
{
    //protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';


    protected static string $settings = GeneralSettings::class;

   // protected static ?string $title = 'Custom Page Title';

    //protected static ?string $navigationLabel = 'Custom Navigation Label';

    //protected ?string $heading = 'Custom Page Heading';

    
    protected static ?string $slug = 'setting/report';

    protected static ?string $navigationGroup = 'Settings';


    public static function getNavigationGroup(): ?string
    {
        return __('common.resource.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.resource.report_param');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('site_name')
                ->label('Site Name')
                ->required(),
            ]);
    }
}
