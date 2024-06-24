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
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

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
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('serial_number')
                                    ->label('Serie del Equipo')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100)
                                    ->required(),
                                TextInput::make('brand')
                                    ->label('Marca')
                                    ->maxLength(100)
                                    ->required(),
                                TextInput::make('model')
                                    ->label('Modelo')
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
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100),
                                TextInput::make('location')
                                    ->label('Ubicación')
                                    ->maxLength(255),
                                DatePicker::make('purchase_date')
                                    ->label('Fecha de Compra')
                                    ->format('d/m/Y')
                                    ->native(false),
                                TextInput::make('price')
                                    ->label('Valor de Compra')
                                    ->maxLength(25),
                                TextInput::make('provider')
                                    ->label('Proveedor')
                                    ->maxLength(100),
                                DatePicker::make('assignment_date')
                                    ->label('Fecha de Asignación')
                                    ->format('d/m/Y')
                                    ->native(false),
                                DatePicker::make('return_date')
                                    ->label('Fecha de Devolución')
                                    ->format('d/m/Y')
                                    ->native(false),
                                TextInput::make('details')
                                    ->label('Detalles'),
                            ]),
                        Tabs\Tab::make('Datos Técnicos')
                            ->icon('heroicon-m-cpu-chip')
                            ->schema([
                                TextInput::make('os')
                                    ->label('Sistema Operativo')
                                    ->maxLength(255),
                                TextInput::make('bios_password')
                                    ->label('Contraseña BIOS')
                                    ->maxLength(100),
                                TextInput::make('mac_address')
                                    ->label('Dirección MAC')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('cpu')
                                    ->label('CPU')
                                    ->maxLength(255),
                                TextInput::make('ram')
                                    ->label('RAM')
                                    ->maxLength(255),
                                TextInput::make('gpu')
                                    ->label('GPU')
                                    ->maxLength(255),
                                TextInput::make('storage')
                                    ->label('Almacenamiento')
                                    ->maxLength(255),
                                TextInput::make('serial_storage')
                                    ->label('Serie del Almacenamiento')
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
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                TextColumn::make('serial_number')
                    ->label('Serie del Equipo')
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
