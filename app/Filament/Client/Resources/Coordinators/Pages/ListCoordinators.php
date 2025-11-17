<?php

namespace App\Filament\Client\Resources\Coordinators\Pages;

use App\Filament\Client\Resources\Coordinators\CoordinatorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListCoordinators extends ListRecords
{
    protected static string $resource = CoordinatorResource::class;
    protected static ?string $title = 'Coordenadores';
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Novo Coordenador')
                ->icon(Heroicon::UserPlus),
        ];
    }
}
