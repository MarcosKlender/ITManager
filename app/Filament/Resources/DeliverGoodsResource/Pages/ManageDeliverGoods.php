<?php

namespace App\Filament\Resources\DeliverGoodsResource\Pages;

use App\Filament\Resources\DeliverGoodsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDeliverGoods extends ManageRecords
{
    protected static string $resource = DeliverGoodsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
