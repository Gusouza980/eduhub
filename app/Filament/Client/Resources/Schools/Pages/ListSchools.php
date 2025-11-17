<?php

namespace App\Filament\Client\Resources\Schools\Pages;

use App\Filament\Client\Resources\Schools\SchoolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolResource::class;
    protected static ?string $title = 'Escolas';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nova Escola')
                ->icon(Heroicon::OutlinedPlus),
        ];
    }
}
