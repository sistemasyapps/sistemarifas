<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use Filament\Resources\Resource;

class TicketResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Tickets';

    protected static ?string $modelLabel = 'Ver Ticket';


    public static function getPages(): array
    {
        return [
            'index' => Pages\Tickets::route('/'),
        ];
    }
}
