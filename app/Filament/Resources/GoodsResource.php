<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsResource\Pages;
use App\Filament\Resources\GoodsResource\RelationManagers;
use App\Models\Goods;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\TextInput::make('location')
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
                Tables\Columns\TextColumn::make('location')
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
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGoods::route('/create'),
            'edit' => Pages\EditGoods::route('/{record}/edit'),
        ];
    }
}
