<?php

namespace App\Filament\Resources\MetodoPagoResource\Pages;

use App\Filament\Resources\MetodoPagoResource;
use App\Models\MetodoPago;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;

class ReorderMetodoPagos extends ListRecords
{
    protected static string $resource = MetodoPagoResource::class;

    protected static ?string $title = 'Ordenar Metodos';

    protected static ?string $navigationLabel = 'Ordenar Metodos';

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';

    public function mount(): void
    {
        parent::mount();

        $this->isTableReordering = true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(MetodoPago::query()->orderBy('orden')->orderBy('id'))
            ->reorderable('orden')
            ->defaultSort('orden')
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('metodo')
                    ->label('Método de Pago')
                    ->weight('bold')
                    ->searchable(),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
