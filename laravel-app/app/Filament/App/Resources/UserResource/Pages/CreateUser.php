<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
