<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaffleResource\Pages;
use App\Filament\Resources\RaffleResource\RelationManagers;
use App\Models\Raffle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

class RaffleResource extends Resource
{
    protected static ?string $model = Raffle::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Rifas';

    protected static ?string $modelLabel = 'Rifa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Radio::make('estatus')
                    ->options([
                        '0' => 'Cerrada',
                        '1' => 'Activa',
                    ]),
                Forms\Components\TextInput::make('cantidad_max')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('precio')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha_inicial')
                    ->native(false)
                    ->displayFormat("d/m/Y")
                    ->required(),
                Forms\Components\DatePicker::make('fecha_final')
                    ->native(false)
                    ->displayFormat("d/m/Y")
                    ->required(),
                Forms\Components\FileUpload::make('imagen_texto'),
                Forms\Components\FileUpload::make('imagen_premio'),
                Forms\Components\FileUpload::make('imagen_banner'),
                TinyEditor::make('descripcion')
                    ->profile('full')
                    ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicial')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_final')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRaffles::route('/'),
            'create' => Pages\CreateRaffle::route('/create'),
            'view' => Pages\ViewRaffle::route('/{record}'),
            'edit' => Pages\EditRaffle::route('/{record}/edit'),
        ];
    }
}
