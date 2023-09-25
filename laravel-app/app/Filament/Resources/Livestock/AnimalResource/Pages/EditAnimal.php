<?php

namespace App\Filament\Resources\Livestock\AnimalResource\Pages;

use App\Filament\Resources\Livestock\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
    
        return $data;
    }

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return false;
    }
}
