<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliverEquipmentResource\Pages;
use App\Filament\Resources\DeliverEquipmentResource\RelationManagers;
use App\Models\DeliverEquipment;
use App\Models\Employee;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliverEquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;
    protected static ?string $modelLabel = 'equipo';

    protected static ?string $navigationGroup = 'Actas de Entrega';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $activeNavigationIcon = 'heroicon-s-document-arrow-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('employee_id', 14))
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                TextColumn::make('serial_number')
                    ->label('Serie del Equipo')
                    ->searchable(),
                TextColumn::make('cne_code')
                    ->label('Código CNE')
                    ->searchable(),
                TextColumn::make('brand')
                    ->label('Marca')
                    ->searchable(),
                TextColumn::make('model')
                    ->label('Modelo')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->searchable(),
                TextColumn::make('employee.name')
                    ->label('Custodio')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
                Tables\Actions\BulkAction::make("entrega")
                    ->label('Generar Acta Entrega')
                    ->icon('heroicon-s-document-text')
                    ->form([
                        Select::make('receiver')
                            ->label('Funcionario/a quien recibe')
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->modalSubmitActionLabel('Descargar')
                    ->modalWidth('lg')
                    ->action(function ($records, $data) {
                        $receiver = Employee::find($data['receiver']);
                        $currentDate = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
                        $currentYear = Carbon::now()->year;
                        $fileName = 'CNE-DPSDT-ITM-' . $currentYear . '-E';

                        $pdf = Pdf::loadView('pdf.acta-entrega', compact('records', 'receiver', 'currentDate', 'fileName'));

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->stream();
                        }, $fileName . '.pdf');
                    })
            ])
            ->deselectAllRecordsWhenFiltered(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDeliverEquipment::route('/'),
        ];
    }
}
