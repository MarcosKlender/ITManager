<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\EmployeeImporter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $modelLabel = 'funcionario';

    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('department')
                            ->columnSpanFull()
                            ->label('Unidad')
                            ->options([
                                'UNIDAD PROVINCIAL DE SEGURIDAD INFORMATICA Y PROYECTOS TECNOLOGICOS ELECTORALES' => 'UNIDAD PROVINCIAL DE SEGURIDAD INFORMATICA Y PROYECTOS TECNOLOGICOS ELECTORALES',
                                'UNIDAD TECNICA PROVINCIAL DE PROCESOS ELECTORALES' => 'UNIDAD TECNICA PROVINCIAL DE PROCESOS ELECTORALES',
                                'UNIDAD PROVINCIAL DE TALENTO HUMANO' => 'UNIDAD PROVINCIAL DE TALENTO HUMANO',
                                'UNIDAD TECNICA PROVINCIAL DE PARTICIPACION POLITICA' => 'UNIDAD TECNICA PROVINCIAL DE PARTICIPACION POLITICA',
                                'UNIDAD DE DESARROLLO DE PRODUCTOS Y SERVICIOS INFORMATIVOS ELECTORALES' => 'UNIDAD DE DESARROLLO DE PRODUCTOS Y SERVICIOS INFORMATIVOS ELECTORALES',
                                'UNIDAD PROVINCIAL FINANCIERA' => 'UNIDAD PROVINCIAL FINANCIERA',
                                'UNIDAD PROVINCIAL ADMINISTRATIVA' => 'UNIDAD PROVINCIAL ADMINISTRATIVA',
                                'UNIDAD PROVINCIAL DE ASESORIA JURIDICA' => 'UNIDAD PROVINCIAL DE ASESORIA JURIDICA',
                                'UNIDAD PROVINCIAL DE GESTION ESTRATEGICA Y PLANIFICACION' => 'UNIDAD PROVINCIAL DE GESTION ESTRATEGICA Y PLANIFICACION',
                                'DIRECCION PROVINCIAL' => 'DIRECCION PROVINCIAL',
                                'UNIDAD PROVINCIAL DE SECRETARIA GENERAL' => 'UNIDAD PROVINCIAL DE SECRETARIA GENERAL',
                                'JUNTA PROVINCIAL ELECTORAL' => 'JUNTA PROVINCIAL ELECTORAL',
                            ])
                            ->native(false)
                            ->searchable()
                            ->required(),
                        TextInput::make('name')
                            ->label('Apellidos y Nombres')
                            ->placeholder('APELLIDOS PRIMERO')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('identification_number')
                            ->label('Cédula de Identidad')
                            ->placeholder('1234567890')
                            ->unique(ignoreRecord: true)
                            ->mask('9999999999')
                            ->length(10)
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->placeholder('correo@cne.gob.ec')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('phone')
                            ->label('Celular')
                            ->placeholder('1234567890')
                            ->mask('9999999999')
                            ->length(10)
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(EmployeeImporter::class)
                    ->hidden(auth()->user()->roles->first()->name != 'ADMIN')
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Apellidos y Nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_number')
                    ->label('Cédula de Identidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo Electrónico'),
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
            RelationManagers\EquipmentRelationManager::class,
            RelationManagers\GoodsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
