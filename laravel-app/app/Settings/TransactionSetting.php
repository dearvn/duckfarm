<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TransactionSetting extends Settings
{

    
    public static function group(): string
    {
        return 'transaction';
    }
}