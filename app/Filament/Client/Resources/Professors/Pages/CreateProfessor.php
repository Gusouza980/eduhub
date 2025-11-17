<?php

namespace App\Filament\Client\Resources\Professors\Pages;

use App\Filament\Client\Resources\Professors\ProfessorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProfessor extends CreateRecord
{
    protected static string $resource = ProfessorResource::class;
    protected static ?string $title = 'Novo Professor';

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['client_id'] = getClientId();
        return $data;
    }
}
