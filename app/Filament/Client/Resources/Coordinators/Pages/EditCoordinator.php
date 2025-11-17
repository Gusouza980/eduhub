<?php

namespace App\Filament\Client\Resources\Coordinators\Pages;

use App\Filament\Client\Resources\Coordinators\CoordinatorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCoordinator extends EditRecord
{
    protected static string $resource = CoordinatorResource::class;
    protected static ?string $title = 'Editar Coordenador';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
