<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Filament\Resources\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\EquipmentImporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\EquipmentExporter;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;
    protected static ?string $modelLabel = 'equipo';

    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $activeNavigationIcon = 'heroicon-s-computer-desktop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Datos Obligatorios')
                            ->icon('heroicon-m-exclamation-circle')
                            ->schema([
                                Select::make('employee_id')
                                    ->label('Custodio')
                                    ->relationship('employee', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                TextInput::make('type')
                                    ->label('Tipo')
                                    ->placeholder('TIPO DE EQUIPO')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('serial_number')
                                    ->label('Serie del Equipo')
                                    ->placeholder('NKP324HJ006L00027')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100)
                                    ->required(),
                                TextInput::make('brand')
                                    ->label('Marca')
                                    ->placeholder('NOMBRE DE LA MARCA')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(100)
                                    ->required(),
                                TextInput::make('model')
                                    ->label('Modelo')
                                    ->placeholder('NOMBRE DEL MODELO')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(100)
                                    ->required(),
                                Select::make('status')
                                    ->label('Estado')
                                    ->options([
                                        'BUENO' => 'BUENO',
                                        'REGULAR' => 'REGULAR',
                                        'MALO' => 'MALO',
                                    ])
                                    ->native(false)
                                    ->required(),
                            ]),
                        Tabs\Tab::make('Datos Administrativos')
                            ->icon('heroicon-m-archive-box')
                            ->schema([
                                TextInput::make('cne_code')
                                    ->label('Código CNE')
                                    ->placeholder('16165830')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100),
                                TextInput::make('location')
                                    ->label('Ubicación')
                                    ->placeholder('LUGAR DONDE SE ENCUENTRA EL EQUIPO')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                DatePicker::make('purchase_date')
                                    ->label('Fecha de Compra')
                                    ->format('d/m/Y'),
                                TextInput::make('price')
                                    ->label('Valor de Compra')
                                    ->placeholder('500.00')
                                    ->numeric()
                                    ->prefix('$')
                                    ->minValue(1)
                                    ->maxValue(10000),
                                TextInput::make('provider')
                                    ->label('Proveedor')
                                    ->placeholder('NOMBRE DEL PROVEEDOR')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(100),
                                DatePicker::make('assignment_date')
                                    ->label('Fecha de Asignación')
                                    ->format('d/m/Y'),
                                DatePicker::make('return_date')
                                    ->label('Fecha de Devolución')
                                    ->format('d/m/Y'),
                                TextInput::make('details')
                                    ->label('Detalles')
                                    ->placeholder('OBSERVACIONES DEL EQUIPO')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                            ]),
                        Tabs\Tab::make('Datos Técnicos')
                            ->icon('heroicon-m-cpu-chip')
                            ->schema([
                                TextInput::make('os')
                                    ->label('Sistema Operativo')
                                    ->placeholder('W10 PRO')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                TextInput::make('bios_password')
                                    ->label('Contraseña BIOS')
                                    ->placeholder('SI NO TIENE CONTRASEÑA DEJE VACÍO ESTE CAMPO')
                                    ->maxLength(100),
                                TextInput::make('mac_address')
                                    ->label('Dirección MAC')
                                    ->placeholder('A1:B2:C3:D4:E5:F6')
                                    ->unique(ignoreRecord: true)
                                    ->mask('**:**:**:**:**:**')
                                    ->macAddress(),
                                TextInput::make('cpu')
                                    ->label('CPU')
                                    ->placeholder('INTEL CORE I7 8700K')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                TextInput::make('ram')
                                    ->label('RAM')
                                    ->placeholder('2 X 8 GB DDR4')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                TextInput::make('gpu')
                                    ->label('GPU')
                                    ->placeholder('GRAFICOS INTEGRADOS')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                TextInput::make('storage')
                                    ->label('Almacenamiento')
                                    ->placeholder('KINGSTON SSD 480 GB')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->maxLength(255),
                                TextInput::make('serial_storage')
                                    ->label('Serie del Almacenamiento')
                                    ->placeholder('SBF42RE4')
                                    ->dehydrateStateUsing(fn($state) => strtoupper($state))
                                    ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100),
                            ]),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(EquipmentExporter::class)
                    ->icon('heroicon-o-arrow-down-tray'),
                ImportAction::make()
                    ->importer(EquipmentImporter::class)
                    ->icon('heroicon-o-arrow-up-tray')
                    ->hidden(auth()->user()->roles->first()->name != 'ADMIN')
            ])
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
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
