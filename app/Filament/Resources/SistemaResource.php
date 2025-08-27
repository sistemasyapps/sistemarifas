<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SistemaResource\Pages;
use Filament\Resources\Resource;

class SistemaResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Configurar Sistema';

    protected static ?string $modelLabel = 'Configurar Sistema';


    public static function getPages(): array
    {
        return [
            'index' => Pages\Sistema::route('/'),
        ];
    }
}
