<?php

namespace App\Filament\Resources\RrssResource\Pages;

use App\Filament\Resources\RrssResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRrss extends EditRecord
{
    protected static string $resource = RrssResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
