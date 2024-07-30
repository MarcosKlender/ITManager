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
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ImportAction;
use App\Filament\Imports\GoodsImporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\GoodsExporter;
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
                            ->required(),
                        TextInput::make('type')
                            ->label('Tipo')
                            ->placeholder('TIPO DEL BIEN')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('serial_number')
                            ->label('Serie del Bien')
                            ->placeholder('NKP324HJ006L00027')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->unique(ignoreRecord: true)
                            ->maxLength(100)
                            ->required(),
                        TextInput::make('brand')
                            ->label('Marca')
                            ->placeholder('NOMBRE DE LA MARCA')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->maxLength(100)
                            ->required(),
                        TextInput::make('model')
                            ->label('Modelo')
                            ->placeholder('NOMBRE DEL MODELO')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
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
                        TextInput::make('cne_code')
                            ->label('Código CNE')
                            ->placeholder('16165830')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->unique(ignoreRecord: true)
                            ->maxLength(100),
                        TextInput::make('location')
                            ->label('Ubicación')
                            ->placeholder('LUGAR DONDE SE ENCUENTRA EL BIEN')
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state))
                            ->extraInputAttributes(['onkeyup' => RawJs::make('this.value = this.value.toUpperCase();')])
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->exporter(GoodsExporter::class)
                    ->icon('heroicon-o-arrow-down-tray'),
                ImportAction::make()
                    ->importer(GoodsImporter::class)
                    ->icon('heroicon-o-arrow-up-tray')
                    ->hidden(auth()->user()->roles->first()->name != 'ADMIN')
            ])
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
            'index' => Pages\ListGoods::route('/'),
            'create' => Pages\CreateGoods::route('/create'),
            'edit' => Pages\EditGoods::route('/{record}/edit'),
        ];
    }
}
