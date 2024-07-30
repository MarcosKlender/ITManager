<?php

namespace App\Filament\Imports;

use App\Models\Equipment;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class EquipmentImporter extends Importer
{
    protected static ?string $model = Equipment::class;

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
            ImportColumn::make('purchase_date')
                ->rules(['max:50']),
            ImportColumn::make('price')
                ->rules(['max:25']),
            ImportColumn::make('provider')
                ->rules(['max:100']),
            ImportColumn::make('assignment_date')
                ->rules(['max:50']),
            ImportColumn::make('return_date')
                ->rules(['max:50']),
            ImportColumn::make('details')
                ->rules(['max:255']),
            ImportColumn::make('os')
                ->rules(['max:255']),
            ImportColumn::make('bios_password')
                ->rules(['max:100']),
            ImportColumn::make('mac_address')
                ->rules(['max:17']),
            ImportColumn::make('cpu')
                ->rules(['max:255']),
            ImportColumn::make('ram')
                ->rules(['max:255']),
            ImportColumn::make('gpu')
                ->rules(['max:255']),
            ImportColumn::make('storage')
                ->rules(['max:255']),
            ImportColumn::make('serial_storage')
                ->rules(['max:100']),
        ];
    }

    public function resolveRecord(): ?Equipment
    {
        // return Equipment::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Equipment();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your equipment import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
