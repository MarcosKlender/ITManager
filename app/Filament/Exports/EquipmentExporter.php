<?php

namespace App\Filament\Exports;

use App\Models\Equipment;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\Style;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\CellAlignment;

class EquipmentExporter extends Exporter
{
    protected static ?string $model = Equipment::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->enabledByDefault(false)
                ->label('ID'),
            ExportColumn::make('employee.department')
                ->label('Unidad'),
            ExportColumn::make('employee.name')
                ->label('Custodio'),
            ExportColumn::make('type')
                ->label('Tipo'),
            ExportColumn::make('serial_number')
                ->label('Serie del Equipo'),
            ExportColumn::make('brand')
                ->label('Marca'),
            ExportColumn::make('model')
                ->label('Modelo'),
            ExportColumn::make('status')
                ->label('Estado'),
            ExportColumn::make('cne_code')
                ->label('Código CNE'),
            ExportColumn::make('location')
                ->label('Ubicación'),
            ExportColumn::make('purchase_date')
                ->label('Fecha de Compra'),
            ExportColumn::make('price')
                ->label('Valor de Compra'),
            ExportColumn::make('provider')
                ->label('Proveedor'),
            ExportColumn::make('assignment_date')
                ->label('Fecha de Asignación'),
            ExportColumn::make('return_date')
                ->label('Fecha de Devolución'),
            ExportColumn::make('details')
                ->label('Detalles'),
            ExportColumn::make('os')
                ->label('Sistema Operativo'),
            ExportColumn::make('bios_password')
                ->label('Contraseña BIOS'),
            ExportColumn::make('mac_address')
                ->label('Dirección MAC'),
            ExportColumn::make('cpu')
                ->label('CPU'),
            ExportColumn::make('ram')
                ->label('RAM'),
            ExportColumn::make('gpu')
                ->label('GPU'),
            ExportColumn::make('storage')
                ->label('Almacenamiento'),
            ExportColumn::make('serial_storage')
                ->label('Serie del Almacenamiento'),
            ExportColumn::make('created_at')
                ->enabledByDefault(false)
                ->label('Fecha de Creación'),
            ExportColumn::make('updated_at')
                ->enabledByDefault(false)
                ->label('Fecha de Edición'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = number_format($export->successful_rows) . ' ' . str('fila')->plural($export->successful_rows) . ' han sido exportadas.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        $date = date("d-m-Y_H-i-s");

        return "{$export->getKey()}_Equipos_{$date}";
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setCellAlignment(CellAlignment::CENTER)
            ->setFontColor(Color::rgb(255, 255, 255))
            ->setBackgroundColor(Color::rgb(0, 62, 115));
    }
}
