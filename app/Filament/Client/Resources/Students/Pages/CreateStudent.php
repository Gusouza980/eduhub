<?php

namespace App\Filament\Client\Resources\Students\Pages;

use App\Filament\Client\Resources\Students\StudentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected static ?string $title = 'Novo Estudante';

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['client_id'] = getClientId();
        return $data;
    }
}
