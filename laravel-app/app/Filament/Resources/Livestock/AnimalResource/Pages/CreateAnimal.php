<?php

namespace App\Filament\Resources\Livestock\AnimalResource\Pages;

use App\Filament\Resources\Livestock\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
}
