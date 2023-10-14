<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Facades\FilamentAuthenticate;
use App\Filament\Resources\UserResource;
use App\Support\Utils;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return $data;
    }

    /*public function afterSave(): void
    {
        if (! is_a($this->record, Utils::getUserModel())) {
            return;
        }

        FilamentAuthenticate::clearPermissionCache();
    }*/
}
