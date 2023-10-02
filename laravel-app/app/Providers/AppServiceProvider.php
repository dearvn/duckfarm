<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(trans('common.resource.livestock'))
                    ->icon('heroicon-o-rectangle-group'),
                NavigationGroup::make()
                    ->label(trans('common.resource.plantings'))
                    ->icon('heroicon-o-qr-code'),
                NavigationGroup::make()
                    ->label(trans('common.resource.resources'))
                    ->icon('heroicon-m-inbox-stack'),
                NavigationGroup::make()
                     ->label(trans('common.resource.accounting'))
                     ->icon('heroicon-o-currency-dollar'),
                NavigationGroup::make()
                     ->label(trans('common.resource.market'))
                     ->icon('heroicon-o-shopping-cart'),
                NavigationGroup::make()
                    ->label(trans('common.resource.climate'))
                    ->icon('heroicon-o-bolt-slash'),
                NavigationGroup::make()
                    ->label(trans('common.resource.reports'))
                    ->icon('heroicon-m-chart-bar-square'),
                NavigationGroup::make()
                    ->label(trans('common.resource.settings'))
                    ->icon('heroicon-o-cog-8-tooth')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label(trans('common.resource.administration'))
                    ->icon('heroicon-o-cog-8-tooth')
                    ->collapsed(),
            ]);
        });

        /*seo()
            ->site(config('app.name'))
            ->title(
                modify: fn (string $title) => $title . ' - ' . config('app.name'),
                default: 'Filament - Accelerated Laravel development framework: admin panel, form builder, table builder and more',
            )
            ->description(default: 'A collection of beautiful full-stack components for Laravel. The perfect starting point for your next app. Using Livewire, Alpine.js and Tailwind CSS.')
            ->twitterSite('filamentphp');
                */
                
       /* Model::preventLazyLoading(! app()->isProduction());
        Model::unguard();

        Relation::enforceMorphMap([
            'article' => Article::class,
            'plugin' => Plugin::class,
        ]);

        URL::forceScheme('https');*/

    }
}
