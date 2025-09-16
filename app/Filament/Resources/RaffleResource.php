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
use Closure;
use Illuminate\Support\Carbon;

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
                    ->required()
                    ->options([
                        '0' => 'Cerrada',
                        '1' => 'Activa',
                    ]),
                    Forms\Components\Radio::make('estatus_compra')
                    ->required()
                    ->options([
                        '0' => 'Cerrar Compras',
                        '1' => 'Activar Compras',
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
                Forms\Components\Textarea::make('mensaje_proximo_sorteo')
                    ->label('Mensaje próximo sorteo')
                    ->helperText('Si se define, reemplaza la fecha inicial mostrada al comprar tickets.')
                    ->rows(2)
                    ->reactive(),
                Forms\Components\DatePicker::make('fecha_inicial')
                    ->native(false)
                    ->displayFormat("d/m/Y")
                    ->nullable()
                    ->required(fn (callable $get) => blank($get('mensaje_proximo_sorteo')))
                    ->minDate(Carbon::today()->subDay())
                    ->rule(fn (callable $get) => function (string $attribute, $value, Closure $fail) use ($get) {
                        if (blank($value)) {
                            return;
                        }

                        $final = $get('fecha_final');
                        if (blank($final)) {
                            return;
                        }

                        if (strtotime($value) > strtotime($final)) {
                            $fail('La fecha inicial debe ser menor o igual a la fecha final.');
                        }
                    })
                    ->validationMessages([
                        'after_or_equal' => 'La fecha inicial debe ser igual o posterior a la fecha mínima permitida.',
                        'before_or_equal' => 'La fecha inicial debe ser menor o igual a la fecha final.',
                    ])
                    ->helperText('Obligatoria cuando no se define un mensaje.'),
                Forms\Components\DatePicker::make('fecha_final')
                    ->native(false)
                    ->displayFormat("d/m/Y")
                    ->nullable()
                    ->required(fn (callable $get) => blank($get('mensaje_proximo_sorteo')))
                    ->minDate(fn (callable $get) => $get('fecha_inicial')
                        ? Carbon::parse($get('fecha_inicial'))
                        : Carbon::today()->subDay())
                    ->rule(fn (callable $get) => function (string $attribute, $value, Closure $fail) use ($get) {
                        if (blank($value)) {
                            return;
                        }

                        $initial = $get('fecha_inicial');
                        if (blank($initial)) {
                            return;
                        }

                        if (strtotime($value) < strtotime($initial)) {
                            $fail('La fecha final debe ser mayor o igual a la fecha inicial.');
                        }
                    })
                    ->validationMessages([
                        'after_or_equal' => 'La fecha final debe ser mayor o igual a la fecha inicial.',
                        'before_or_equal' => 'La fecha final debe ser mayor o igual a la fecha inicial.',
                    ])
                    ->helperText('Obligatoria cuando no se define un mensaje.'),
                Forms\Components\FileUpload::make('imagen_premio'),
                Forms\Components\FileUpload::make('imagen_banner'),
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
