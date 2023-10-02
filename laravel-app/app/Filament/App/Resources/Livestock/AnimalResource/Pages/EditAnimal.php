<?php

namespace App\Filament\App\Resources\Livestock\AnimalResource\Pages;

use App\Filament\App\Resources\Livestock\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ])->icon('heroicon-m-ellipsis-horizontal')
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
