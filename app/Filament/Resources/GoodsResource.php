<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsResource\Pages;
use App\Filament\Resources\GoodsResource\RelationManagers;
use App\Models\Goods;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GoodsResource extends Resource
{
    protected static ?string $model = Goods::class;
    protected static ?string $modelLabel = 'bien';
    protected static ?string $pluralModelLabel = 'bienes';

    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $activeNavigationIcon = 'heroicon-s-archive-box';

    public static function form(Form $form): Form
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
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('type')
                            ->label('Tipo')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('serial_number')
                            ->label('Serie del Bien')
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
                        TextInput::make('cne_code')
                            ->label('Código CNE')
                            ->maxLength(100),
                        TextInput::make('location')
                            ->label('Ubicación')
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
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
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGoods::route('/create'),
            'edit' => Pages\EditGoods::route('/{record}/edit'),
        ];
    }
}
