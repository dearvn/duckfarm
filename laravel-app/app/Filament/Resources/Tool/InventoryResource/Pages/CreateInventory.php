<?php

namespace App\Filament\Resources\Tool\InventoryResource\Pages;

use App\Filament\Resources\Tool\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class CreateInventory extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = InventoryResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make(trans('inventory.resource.step1'))
                ->schema([
                    Section::make()->schema(InventoryResource::getFormSchema())->columns(),
                ]),

            Step::make(trans('inventory.resource.step2'))
                ->schema([
                    Section::make()->schema(InventoryResource::getFormSchema('warehouse')),
                ]),
        ];
    }
}
