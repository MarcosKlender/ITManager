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
use Filament\Tables;
use Filament\Tables\Table;
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

                        TextInput::make('name')
                            ->label('Nombres y Apellidos')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('identification_number')
                            ->label('Cédula de Identidad')
                            ->unique(ignoreRecord: true)
                            ->maxLength(10)
                            ->required(),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->suffix('@cne.gob.ec')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->required(),
                        Select::make('department')
                            ->options([
                                'TICS' => 'TICS',
                                'Procesos Electorales' => 'Procesos Electorales',
                                'Talento Humano' => 'Talento Humano',
                                'Participación Política' => 'Participación Política',
                                'Comunicación' => 'Comunicación',
                                'Financiero' => 'Financiero',
                                'Administrativo' => 'Administrativo',
                                'Jurídico' => 'Jurídico',
                                'Planificación' => 'Planificación',
                                'Dirección' => 'Dirección',
                                'Secretaría General' => 'Secretaría General',
                                'Recaudación' => 'Recaudación',
                                'Guardianía' => 'Guardianía',
                                'JPE' => 'JPE',
                            ])
                            ->native(false)
                            ->searchable()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Celular')
                            ->tel()
                            ->maxLength(10)
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombres y Apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_number')
                    ->label('Cédula de Identidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->label('Departamento'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Celular'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
