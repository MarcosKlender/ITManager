<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReturnGoodsResource\Pages;
use App\Filament\Resources\ReturnGoodsResource\RelationManagers;
use App\Models\Employee;
use App\Models\Goods;
use App\Models\PdfCounter;
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

class ReturnGoodsResource extends Resource
{
    protected static ?string $model = Goods::class;
    protected static ?string $modelLabel = 'bien';
    protected static ?string $pluralModelLabel = 'bienes';

    protected static ?string $navigationGroup = 'Devolución';
    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $activeNavigationIcon = 'heroicon-o-document-arrow-down';

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
            ->modifyQueryUsing(fn(Builder $query) => $query->whereNot('employee_id', env('BOSS_ID')))
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
                Tables\Actions\BulkAction::make("devolucion")
                    ->label('Generar Acta Devolución')
                    ->icon('heroicon-s-document-text')
                    ->form([
                        Select::make('employee')
                            ->label('Funcionario/a quien devuelve')
                            ->relationship('employee', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->modalSubmitActionLabel('Descargar')
                    ->modalWidth('lg')
                    ->action(function ($records, $data) {
                        $boss = Employee::find(env('BOSS_ID'));
                        $employee = Employee::find($data['employee']);

                        $currentDate = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
                        $currentYear = Carbon::now()->year;

                        $pdfCounter = PdfCounter::where('type', 'devolucion_bienes')->first();
                        $pdfCounter->increment('counter');
                        $currentCounter = $pdfCounter->counter;

                        $isDeliver = false;
                        $fileName = 'CNE-DPSDT-ITM-' . $currentYear . '-' . $currentCounter . '-DB';

                        $pdf = Pdf::loadView('pdf.acta-er', compact('records', 'boss', 'employee', 'currentDate', 'isDeliver', 'fileName'));

                        foreach ($records as $record) {
                            $record->employee_id = $boss->id;
                            $record->save();
                        }

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
            'index' => Pages\ManageReturnGoods::route('/'),
        ];
    }
}
