<?php

namespace App\Filament\Resources\ReturnGoodsResource\Pages;

use App\Filament\Resources\ReturnGoodsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageReturnGoods extends ManageRecords
{
    protected static string $resource = ReturnGoodsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
