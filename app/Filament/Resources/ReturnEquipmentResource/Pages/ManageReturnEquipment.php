<?php

namespace App\Filament\Resources\ReturnEquipmentResource\Pages;

use App\Filament\Resources\ReturnEquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageReturnEquipment extends ManageRecords
{
    protected static string $resource = ReturnEquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
