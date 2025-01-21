<?php

namespace App\Filament\Resources\GanadoresResource\Pages;

use App\Filament\Resources\GanadoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGanadores extends EditRecord
{
    protected static string $resource = GanadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
