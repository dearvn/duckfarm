<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class Address extends Component
{
    protected string $view = 'forms.components.address';

    public static function make(): static
    {
        return app(static::class);
    }
}
