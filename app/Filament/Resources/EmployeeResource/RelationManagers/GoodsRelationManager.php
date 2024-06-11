<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GoodsRelationManager extends RelationManager
{
    protected static string $relationship = 'goods';

    protected static ?string $title = 'Bienes';
    protected static ?string $modelLabel = 'bien';
    protected static ?string $pluralModelLabel = 'bienes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
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
                            ->label('Serie del Bien')
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
                        TextInput::make('cne_code')
                            ->label('Código CNE')
                            ->unique(ignoreRecord: true)
                            ->maxLength(100),
                        TextInput::make('location')
                            ->label('Ubicación')
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('serial_number')
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                TextColumn::make('serial_number')
                    ->label('Serie del Bien')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
