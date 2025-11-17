<?php

namespace App\Filament\Client\Resources\Coordinators\Pages;

use App\Enums\UserRolesEnum;
use App\Filament\Client\Resources\Coordinators\CoordinatorResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCoordinator extends CreateRecord
{
    protected static string $resource = CoordinatorResource::class;
    protected static ?string $title = 'Novo Coordenador';
    

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['client_id'] = getClientId();
        return $data;
    }
}
