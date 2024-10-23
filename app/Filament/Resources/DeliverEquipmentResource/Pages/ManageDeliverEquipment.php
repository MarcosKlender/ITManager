<?php

namespace App\Filament\Resources\DeliverEquipmentResource\Pages;

use App\Filament\Resources\DeliverEquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDeliverEquipment extends ManageRecords
{
    protected static string $resource = DeliverEquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
