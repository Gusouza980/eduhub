<?php

namespace App\Filament\Client\Resources\Coordinators\Pages;

use App\Filament\Client\Resources\Coordinators\CoordinatorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCoordinator extends ViewRecord
{
    protected static string $resource = CoordinatorResource::class;
    protected static ?string $title = 'Visualizar Coordenador';
    
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
