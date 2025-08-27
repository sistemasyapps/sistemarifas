<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RrssResource\Pages;
use App\Filament\Resources\RrssResource\RelationManagers;
use App\Models\Rrss;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RrssResource extends Resource
{
    protected static ?string $model = Rrss::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Redes Sociales';

    protected static ?string $modelLabel = 'Redes Sociales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Radio::make('estatus')
                    ->options([
                        '0' => 'Ocultar',
                        '1' => 'Mostrar',
                ]),
                Forms\Components\Select::make('tipo')
                    ->options([
                        'instagram' => 'Instagram',
                        'facebook' => 'facebook',
                        'tiktok' => 'tiktok',
                ]),
                 Forms\Components\TextInput::make('link')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('tipo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable()
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
            'index' => Pages\ListRrsses::route('/'),
            'create' => Pages\CreateRrss::route('/create'),
            'edit' => Pages\EditRrss::route('/{record}/edit'),
        ];
    }
}
