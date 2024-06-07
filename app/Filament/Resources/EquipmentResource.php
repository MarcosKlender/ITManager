<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Filament\Resources\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('cne_code')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('bios_password')
                    ->password()
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('cpu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ram')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('storage')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial_storage')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('os')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mac_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('employee_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cne_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('storage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_storage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('os')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mac_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employee_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
