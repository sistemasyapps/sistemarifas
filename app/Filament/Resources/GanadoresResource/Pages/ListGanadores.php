<?php

namespace App\Filament\Resources\GanadoresResource\Pages;

use App\Filament\Resources\GanadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGanadores extends ListRecords
{
    protected static string $resource = GanadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
