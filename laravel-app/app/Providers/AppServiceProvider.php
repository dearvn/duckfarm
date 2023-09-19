<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Livestock')
                    ->icon('heroicon-o-rectangle-group'),
                NavigationGroup::make()
                    ->label('Plantings')
                    ->icon('heroicon-o-qr-code'),
                NavigationGroup::make()
                    ->label('Resources')
                    ->icon('heroicon-m-inbox-stack'),
                NavigationGroup::make()
                     ->label('Accounting')
                     ->icon('heroicon-s-currency-dollar'),
                NavigationGroup::make()
                     ->label('Market')
                     ->icon('heroicon-s-shopping-cart'),
                NavigationGroup::make()
                    ->label('Climate')
                    ->icon('heroicon-o-bolt-slash'),
                NavigationGroup::make()
                    ->label('Reports')
                    ->icon('heroicon-m-chart-bar-square'),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-8-tooth')
                    ->collapsed(),
            ]);
        });

    }
}
