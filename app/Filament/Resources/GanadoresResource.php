<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GanadoresResource\Pages;
use App\Filament\Resources\GanadoresResource\RelationManagers;
use App\Models\Winner;
use App\Models\WinnerPhotos;

use App\Models\Raffle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Exception;

class GanadoresResource extends Resource
{
    protected static ?string $model = Winner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Ganadores';

    protected static ?string $modelLabel = 'Ganador';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('raffle_id')
                    ->label('Rifa')
                    ->options(Raffle::all()->pluck('nombre', 'id')),
                Forms\Components\FileUpload::make('photos')
                    ->multiple()
                    ->directory("winner_photos")
                    ->afterStateUpdated(function (callable $set, $state, $record) {
                        if ($state) {
                            foreach ($state as $file) {
                                try{
                                    Log::info('Creando winner photo');
                                    $fileName = time() . '_' . $file->getClientOriginalName();
                                    $filePath = $file->storeAs('winner_photos', $fileName, 'public');

                                    WinnerPhotos::create([
                                        'winner_id' => $record->id,
                                        'photo' => $filePath,
                                    ]);
                                } catch(Exception $e) {
                                    Log::info('Entro por el error de crear photo'.$e->getMessage());
                                }
                            }
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListGanadores::route('/'),
            'create' => Pages\CreateGanadores::route('/create'),
            'edit' => Pages\EditGanadores::route('/{record}/edit'),
        ];
    }
}
