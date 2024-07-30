<?php

namespace App\Filament\Imports;

use App\Models\Goods;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GoodsImporter extends Importer
{
    protected static ?string $model = Goods::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('employee_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('serial_number')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('brand')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('model')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required', 'max:50']),
            ImportColumn::make('cne_code')
                ->rules(['max:100']),
            ImportColumn::make('location')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Goods
    {
        // return Goods::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Goods();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your goods import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
