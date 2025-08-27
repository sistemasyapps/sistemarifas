<?php

namespace App\Filament\Resources\RrssResource\Pages;

use App\Filament\Resources\RrssResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRrsses extends ListRecords
{
    protected static string $resource = RrssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
